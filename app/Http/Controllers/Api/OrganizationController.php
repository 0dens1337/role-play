<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddMemberRequest;
use App\Http\Requests\Api\CreateOrganizationRequest;
use App\Http\Requests\Api\DemoteMemberRequest;
use App\Http\Requests\Api\KickMemberRequest;
use App\Http\Requests\Api\OrganizationFilterRequest;
use App\Http\Requests\Api\PromoteMemberRequest;
use App\Http\Requests\Api\UpdateOrganizationRequest;
use App\Http\Resources\OrganizationIndexResource;
use App\Http\Resources\ShowOrganizationResource;
use App\Models\Organization;
use App\Services\AvatarService;
use App\Services\OrganizationRoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

class OrganizationController extends Controller
{
    public function index(OrganizationFilterRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $query = Organization::query()
            ->filter($validated);

        $organizations = ! empty($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return OrganizationIndexResource::collection($organizations);
    }

    public function create(CreateOrganizationRequest $request): ShowOrganizationResource
    {
        Gate::authorize('create', Organization::class);

        $validated = $request->validated();
        $file = $request->file('logo');

        $organization = Organization::query()->create($validated);

        AvatarService::uploadOrganizationAvatar($file, $organization);

        return ShowOrganizationResource::make($organization);
    }

    public function addMembers(Organization $organization, AddMemberRequest $request): JsonResponse
    {
        Gate::authorize('manage', $organization);

        $charactersIds = $request->validated()['character_ids'];

        if ($organization->characters()->wherePivotIn('character_id', $charactersIds)->exists()) {
            return response()->json([
                'message' => 'Этот персонаж уже в организации'
            ]);
        }

        $charactersCollection = collect($charactersIds);

        $organization->characters()->syncWithoutDetaching(
            collect($charactersCollection->mapWithKeys(fn ($id) => [$id => ['created_at' => now()]]))->toArray()
        );

        return response()->json([
            'message' => 'Персонаж добавлен в оргу',
        ]);
    }

    public function kickMember(Organization $organization, KickMemberRequest $request): JsonResponse
    {
        Gate::authorize('manage', $organization);

        $validated = $request->validated();

        if (! $organization->characters()->wherePivot('character_id', $validated['character_id'])->exists()) {
            return response()->json([
                'message' => 'Такого персонажа нету в орге'
            ]);
        }

        $organization->characters()->detach($validated['character_id']);

        return response()->json([
            'message' => 'Персонаж успешно кикнут'
        ]);
    }

    public function promoteMember(Organization $organization, PromoteMemberRequest $request): JsonResponse
    {
        Gate::authorize('manage', $organization);

        $validated = $request->validated();

        $character = $organization->characters()
            ->wherePivot('character_id', $validated['character_id'])
            ->first();

        if (! $character) {
            return response()->json([
                'message' => 'Данного персонажа нет в орге'
            ], 404);
        }

        $currentExp = $character->pivot->exp;
        $newExp = $currentExp + $validated['exp'];

        $newRole = OrganizationRoleService::getNewRoleByExp($newExp, $character);

        $dataToUpdate = [
            'exp' => $newExp,
            'updated_at' => now(),
        ];

        if ($newRole) {
            $dataToUpdate['role'] = $newRole->value;
        }

        $organization->characters()->updateExistingPivot($character->id, $dataToUpdate);

        return response()->json([
            'message' => 'Персонажу был добавлен опыт'
        ]);
    }

    public function demoteMember(Organization $organization, DemoteMemberRequest $request): JsonResponse
    {
        Gate::authorize('manage', $organization);

        $validated = $request->validated();

        $character = $organization->characters()
            ->wherePivot('character_id', $validated['character_id'])
            ->first();

        if (! $character) {
            return response()->json([
                'message' => 'Данного перса нету в орге'
            ]);
        }

        $currentExp = $character->pivot->exp;
        $newExp = $currentExp - $validated['exp'];

        $newRole = OrganizationRoleService::getNewRoleByExp($newExp, $character);

        $dataToUpdate = [
            'exp' => $newExp,
            'updated_at' => now(),
        ];

        if ($newRole) {
            $dataToUpdate['role'] = $newRole->value;
        }

        $organization->characters()->updateExistingPivot($character->id, $dataToUpdate);

        return response()->json([
            'message' => 'Персонажу был снят опыт'
        ]);
    }

    public function show(Organization $organization): ShowOrganizationResource
    {
        return ShowOrganizationResource::make($organization->load('children'));
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization): AnonymousResourceCollection
    {
        Gate::authorize('update', $organization);

        $validated = $request->validated();

        return ShowOrganizationResource::make($organization->update($validated));
    }

    public function delete(Organization $organization): JsonResponse
    {
        Gate::authorize('delete', $organization);

        $organization->delete();

        return response()->json([
            'message' => 'Organization deleted successfully'
        ]);
    }
}
