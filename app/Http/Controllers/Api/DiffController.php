<?php

namespace App\Http\Controllers\Api;

use App\Enums\CharacterReviewEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FilterDiffRequest;
use App\Http\Requests\Api\SelectiveDiffRequest;
use App\Http\Resources\CharactersShowResource;
use App\Http\Resources\DiffIndexResource;
use App\Http\Resources\DiffResource;
use App\Models\Character;
use App\Models\Diff;
use App\Services\DiffService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DiffController extends Controller
{
    public function index(FilterDiffRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $query = Diff::query()
            ->select('character_id')
            ->distinct()
            ->with('character');

        $characters = !empty($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return DiffIndexResource::collection($characters);
    }

    public function show(Character $character): JsonResponse
    {
        $diffs = $character->diffs()->where('status', CharacterReviewEnum::ON_REVIEW->value)->get();

        return response()->json([
            'character' => new CharactersShowResource($character),
            'diffs' => DiffResource::collection($diffs),
        ]);
    }

    public function acceptAll(Character $character): JsonResponse
    {
        DiffService::acceptAllDiffs($character);

        return response()->json([
            'message' => 'All diffs applied and character updated.',
        ]);
    }

    public function acceptSelectively(Character $character, SelectiveDiffRequest $request): JsonResponse
    {
        $validated = $request->validated();

        DiffService::acceptSelectivelyDiffs($character, $validated);

        return response()->json([
            'message' => 'Selectively applied and character updated.',
        ]);
    }

    public function rejectAll(Character $character): JsonResponse
    {
        DiffService::rejectAllDiffs($character);

        return response()->json([
            'message' => 'All diffs rejected and character not updated.',
        ]);
    }

    public function rejectSelectively(Character $character, SelectiveDiffRequest $request): JsonResponse
    {
        $validated = $request->validated();

        DiffService::rejectSelectivelyDiffs($character, $validated);

        return response()->json([
            'message' => 'Selected diffs rejected and character not updated.',
        ]);
    }
}
