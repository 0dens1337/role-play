<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FilterUserRequest;
use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(FilterUserRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        $query = User::query()->filter($validated);

        $users = ! empty($validated['without_paginate'])
            ? $query->get()
            : $query->paginate($validated['per_page'] ?? 10);

        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request): UserResource
    {
        $user = User::query()->create($request->validated());

        return UserResource::make($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    public function delete(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
