<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateTopicRequest;
use App\Http\Requests\Api\UpdateTopicRequest;
use App\Http\Resources\TopicIndexResource;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TopicController extends Controller
{
    public function indexForEveryone(Request $request): AnonymousResourceCollection
    {
        $topics = Topic::visibleTo()
            ->with('section')
            ->paginate(10);

        return TopicIndexResource::collection($topics);
    }

    public function indexForAuthenticatedUser(): AnonymousResourceCollection
    {
        $query = Topic::query();

        if (!auth()->user()->hasCharacter()) {
            $query->where('has_character', false);
        }

        $topics = $query->paginate(10);

        return TopicIndexResource::collection($topics);
    }

    public function create(CreateTopicRequest $request): TopicResource
    {
        $topic = Topic::query()->create($request->validated());

        return TopicResource::make($topic);
    }

    public function show(Topic $topic)
    {
        Gate::authorize('view', $topic);

        return TopicResource::make($topic);
    }

    public function update(UpdateTopicRequest $request, Topic $topic): TopicResource
    {
        $topic->update($request->validated());

        return TopicResource::make($topic);
    }

    public function delete(Topic $topic): JsonResponse
    {
        $topic->delete();

        return response()->json([
            'message' => 'Topic deleted successfully'
        ]);
    }
}
