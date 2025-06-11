<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FilterTagRequest;
use App\Http\Requests\Api\StoreTagRequest;
use App\Http\Requests\Api\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TagController extends Controller
{
    public function index(FilterTagRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $query = Tag::query()->latest()
            ->filter($validated);

        $npcs = ! empty($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return TagResource::collection($npcs);
    }

    public function create(StoreTagRequest $request)
    {
        $tag = Tag::query()->create($request->validated());

        return TagResource::make($tag);
    }

    public function update(Tag $tag, UpdateTagRequest $request)
    {
        $tag->update($request->validated());

        return TagResource::make($tag);
    }

    public function delete(Tag $tag)
    {
        $tag->delete();

        return response()->json([
            'message' => 'Tag deleted successfully'
        ], 404);
    }
}
