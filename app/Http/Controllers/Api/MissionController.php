<?php

namespace App\Http\Controllers\Api;

use App\Enums\MissionStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateMissionRequest;
use App\Http\Requests\Api\FilterMissionRequest;
use App\Http\Requests\Api\ReviewMissionRequest;
use App\Http\Requests\Api\SendMissionToReviewRequest;
use App\Http\Requests\Api\TakeMissionRequest;
use App\Http\Requests\Api\UpdateMissionRequest;
use App\Http\Resources\MissionResource;
use App\Http\Resources\MissionShowResource;
use App\Models\Mission;
use App\Models\Organization;
use App\Services\DurationConvertService;
use App\Services\ExpCalculationService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MissionController extends Controller
{
    public function index(FilterMissionRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $query = Mission::query()
            ->filter($validated);

        $missions = ! empty($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return MissionResource::collection($missions);
    }

    public function show(Mission $mission): MissionShowResource
    {
        return new MissionShowResource($mission);
    }

    public function create(CreateMissionRequest $request): MissionShowResource
    {
        $mission = Mission::query()
            ->create($request->validated());

        return MissionShowResource::make($mission);
    }

    public function update(Mission $mission, UpdateMissionRequest $request): MissionShowResource
    {
        return MissionShowResource::make($mission->update($request->validated()));
    }

    public function delete(Mission $mission): JsonResponse
    {
        $mission->delete();

        return response()->json([
            'message' => 'Mission deleted successfully'
        ], 204);
    }

    public function takeMission(Mission $mission, TakeMissionRequest $request): JsonResponse
    {
        $characterId = $request->validated()['character_id'];

        if ($mission->characters()->where('character_id', $characterId)->exists()) {
            return response()->json([
                'message' => 'Персонаж уже взял эту миссию.',
            ], 409);
        }

        $deadline = Carbon::now()->addSeconds($mission->duration);

        $mission->characters()->syncWithoutDetaching([
            $characterId => [
                'deadline' => $deadline,
            ]
        ]);

        return response()->json([
            'message' => 'Миссия успешно взята'
        ]);
    }

    public function sendMissionToReview(Mission $mission, SendMissionToReviewRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $pivot = $mission->characters()
            ->wherePivot('character_id', $validated['character_id'])
            ->first();


        if (! $pivot) {
            return response()->json([
                'message' => 'Нет активной миссии у данного персонажа или выбранная миссия не верна'
            ], 404);
        }

        if ($pivot->pivot->deadline < now()) {
            return response()->json([
                'message' => 'Время выполнения задания вышло'
            ], 413);
        }

        $mission->characters()->updateExistingPivot($validated['character_id'], [
            'status' => MissionStatusEnum::ON_REVIEW->value,
            'image_proof' => $validated['image_proof'] ?? null,
            'description_proof' => $validated['description_proof'] ?? null,
        ]);

        return response()->json([
            'message' => 'Пруфы по выполнению миссии отправлены на проверку главе'
        ]);
    }

    public function indexMissionsToReview(Organization $organization): AnonymousResourceCollection
    {
        $missions = Mission::query()
            ->where('organization_id', $organization->id)
            ->whereHas('characters', fn($q) => $q->where('status', MissionStatusEnum::ON_REVIEW->value))
            ->with('characters')
            ->latest()
            ->get();

        return MissionShowResource::collection($missions);
    }

    public function acceptMission(Mission $mission, ReviewMissionRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $mission->load('organization.characters');

        $mission->characters()
            ->updateExistingPivot([$validated['character_id']], [
                'status' => MissionStatusEnum::ACCEPTED->value
            ]);

        ExpCalculationService::addExp($mission, $validated);

        return response()->json([
            'message' => 'Миссия была помечена как выполненная успешно, исполнитель получит награду автоматически.'
        ]);
    }


    public function rejectMission(Mission $mission, ReviewMissionRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $mission->characters()
            ->updateExistingPivot([$validated['character_id']], ['status' => MissionStatusEnum::ACCEPTED->value]);


        return response()->json([
            'message' => 'Миссия была отклонена, причина указывается лично исполнителю.'
        ]);
    }
}
