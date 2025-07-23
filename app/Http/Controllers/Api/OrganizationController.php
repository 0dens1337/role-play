<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddMemberRequest;
use App\Http\Requests\Api\CreateOrganizationRequest;
use App\Http\Requests\Api\OrganizationFilterRequest;
use App\Http\Requests\Api\UpdateOrganizationRequest;
use App\Http\Resources\OrganizationIndexResource;
use App\Http\Resources\ShowOrganizationResource;
use App\Models\Character;
use App\Models\Organization;
use App\Services\AvatarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
        $validated = $request->validated();
        $file = $request->file('logo');

        $organization = Organization::query()->create($validated);

        AvatarService::uploadOrganizationAvatar($file, $organization);

        return ShowOrganizationResource::make($organization);
    }

    public function addMembers(Organization $organization, AddMemberRequest $request): JsonResponse
    {
        $charactersIds = $request->validated()['character_ids'];

        Character::query()->whereIn('id', $charactersIds)
            ->update(['organization_id' => $organization->id]);

        return response()->json([
            'message' => 'Members added to organization',
        ]);
    }

    public function show(Organization $organization): ShowOrganizationResource
    {
        return ShowOrganizationResource::make($organization->load('children'));
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization): AnonymousResourceCollection
    {
        $validated = $request->validated();

        return ShowOrganizationResource::make($organization->update($validated));
    }

    public function delete(Organization $organization): JsonResponse
    {
        $organization->delete();

        return response()->json([
            'message' => 'Organization deleted successfully'
        ]);
    }
}
