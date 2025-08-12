<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LocationFilterRequest;
use App\Http\Requests\Api\StoreLocationRequest;
use App\Http\Requests\Api\UpdateLocationRequest;
use App\Http\Resources\LocationIndexResource;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LocationController extends Controller
{
    public function index(LocationFilterRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $query = Location::query()
            ->latest()
            ->filter($validated);

        $locations = ! empty($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return LocationIndexResource::collection($locations);
    }

    public function show(Location $location): AnonymousResourceCollection
    {
        return LocationResource::collection($location);
    }

    public function create(StoreLocationRequest $request): LocationResource
    {
        $location = Location::query()->create($request->validated());

        return LocationResource::make($location);
    }

    public function update(UpdateLocationRequest $request, Location $location): LocationResource
    {
        return LocationResource::make($location->update($request->validated()));
    }

    public function delete(Location $location): JsonResponse
    {
        $location->delete();

        return response()->json([
            'message' => 'Location deleted successfully'
        ]);
    }
}
