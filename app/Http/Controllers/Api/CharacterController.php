<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateCharacterRequest;
use App\Http\Requests\Api\FilterCharacterRequest;
use App\Http\Requests\Api\StoreCharacterReviewDataRequest;
use App\Http\Requests\Api\UpdateCharacterReviewDataRequest;
use App\Http\Resources\CharactersResource;
use App\Http\Resources\CharactersShowResource;
use App\Http\Resources\DiffResource;
use App\Models\Character;
use App\Services\DataReviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CharacterController extends Controller
{
    public function index(FilterCharacterRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $query = Character::query()->latest()
            ->filter($validated);

        $characters = ! empty($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return CharactersResource::collection($characters);
    }

    public function authUserCharacters(FilterCharacterRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $query = auth()->user()
            ->characters()
            ->latest()
            ->filter($validated);

        $characters  = ! empty($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return CharactersResource::collection($characters);
    }

    public function create(CreateCharacterRequest $request): CharactersShowResource
    {
        $character = Character::query()
            ->create($request->validated());

        return CharactersShowResource::make($character);
    }

    public function createReviewData(Character $character, StoreCharacterReviewDataRequest $request): JsonResponse
    {
        $validated = $request->validated();

        DataReviewService::addDataToReview($character, $validated);

        return response()->json(['message' => 'Данные отправлены на проверку']);
    }

    public function updateReviewData(Character $character, UpdateCharacterReviewDataRequest $request)
    {
        $validated = $request->validated();

        if ($character->just_created) {
            DataReviewService::updateDataForJustCreated($character, $validated);
        }

        DataReviewService::updateDataToReview($character, $validated);

        return response()->json([
            'message' => 'Data was sent successfully',
        ]);
    }
}
