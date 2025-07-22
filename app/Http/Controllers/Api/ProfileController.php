<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UploadUserAvatarRequest;
use App\Http\Resources\ShowUserResource;
use App\Services\AvatarService;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function me(): ShowUserResource
    {
        $user = auth()->user();

        return ShowUserResource::make($user);
    }

    public function uploadAvatar(UploadUserAvatarRequest $request): JsonResponse
    {
        $request->validated();
        $file = $request->file('avatar');

        AvatarService::uploadAvatar($file);

        return response()->json([
            'message' => 'Avatar uploaded successfully',
        ]);
    }
}
