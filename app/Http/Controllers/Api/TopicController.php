<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateTopicRequest;
use App\Http\Resources\TopicIndexResource;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::query()->paginate(10);

        return TopicIndexResource::collection($topics);
    }

    public function create(CreateTopicRequest $request)
    {
        $topic = Topic::query()->create($request->validated());

        return TopicResource::make($topic);
    }
}
