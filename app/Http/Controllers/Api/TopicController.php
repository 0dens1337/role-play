<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateTopicRequest;
use App\Http\Requests\Api\TopicFilterRequest;
use App\Http\Requests\Api\UpdateTopicRequest;
use App\Http\Resources\TopicIndexResource;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

class TopicController extends Controller
{
    public function index(TopicFilterRequest $request)
    {
        Gate::authorize('index', Topic::class);

        $validated = $request->validated();

        $query = Topic::query();

        $topics = isset($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return TopicIndexResource::collection($topics);
    }

    public function indexForEveryone(TopicFilterRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $query = Topic::visibleToEveryone();

        $topics = isset($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return TopicIndexResource::collection($topics);
    }

    public function indexForAuthenticatedUser(TopicFilterRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $query = Topic::query();

        if (!auth()->user()->hasCharacter()) {
            $query->visibleToAuthOnly();
        }

        $topics = isset($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return TopicIndexResource::collection($topics);
    }

    public function create(CreateTopicRequest $request): TopicResource
    {
        Gate::authorize('create', Topic::class);

        $topic = Topic::query()->create($request->validated());

        return TopicResource::make($topic);
    }

    public function show(Topic $topic): TopicResource
    {
        Gate::authorize('view', $topic);

        return TopicResource::make($topic);
    }

    public function update(UpdateTopicRequest $request, Topic $topic): TopicResource
    {
        Gate::authorize('update', $topic);

        $topic->update($request->validated());

        return TopicResource::make($topic);
    }

    public function delete(Topic $topic): JsonResponse
    {
        Gate::authorize('delete', $topic);

        $topic->delete();

        return response()->json([
            'message' => 'Topic deleted successfully'
        ]);
    }
}
