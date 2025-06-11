<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateNpcRequest;
use App\Http\Requests\Api\FilterNpcRequest;
use App\Http\Requests\Api\UpdateNpcRequest;
use App\Http\Resources\NpcResource;
use App\Http\Resources\NpcShowResource;
use App\Models\Npc;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NpcController extends Controller
{
    public function index(FilterNpcRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $query = Npc::query()->latest()
            ->filter($validated);

        $npcs = ! empty($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return NpcResource::collection($npcs);
    }

    public function show(Npc $npc): NpcShowResource
    {
        $npc->load('tags');

        return new NpcShowResource($npc);
    }

    public function create(CreateNpcRequest $request)
    {
        $npc = Npc::query()->create($request->validated());

        return NpcResource::make($npc);
    }

    public function update(Npc $npc, UpdateNpcRequest $request)
    {
        $npc->update($request->validated());

        return NpcShowResource::make($npc);
    }

    public function delete(Npc $npc)
    {
        $npc->delete();

        return response()->json([
            'message' => "Npc deleted successfully"
        ], 404);
    }
}
