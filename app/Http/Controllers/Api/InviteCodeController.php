<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateInviteCodeRequest;
use App\Http\Resources\InviteCodeNumOfCharactersResource;
use App\Http\Resources\InviteCodeResource;
use App\Models\InviteCode;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class InviteCodeController extends Controller
{
    public function indexNumOfCharacters(): AnonymousResourceCollection
    {
        return InviteCodeNumOfCharactersResource::collection(InviteCode::query()->get());
    }

    public function index(): AnonymousResourceCollection
    {
        return InviteCodeResource::collection(InviteCode::query()->get());
    }

    public function store(CreateInviteCodeRequest $request)
    {
        if (InviteCode::query()->exists()) {
            return response()->json([
                'message' => 'Code already exists',
            ]);
        }

        $validated = $request->validated();

        $code = InviteCode::query()
            ->create([
                'code' => $validated['code'],
                'num_of_symbols' => Str::length($validated['code']),
            ]);

        return InviteCodeResource::make($code);
    }

    public function delete(InviteCode $inviteCode)
    {
        $inviteCode->delete();

        return response()->json([
            'message' => 'Invite code deleted'
        ]);
    }
}
