<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use OpenApi\Attributes as OA;

class UserResource extends JsonResource
{
    #[OA\Schema(
        schema: "UserResource",
        title: "User",
        description: "Пользователь",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "login", type: "string", example: "johndoe"),
            new OA\Property(property: "avatar_resize", type: "string", example: "https://example.com/avatar.jpg", nullable: true),
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'login' => $this->resource->login,
            'avatar_resize' => Storage::disk('public')->url($this->resource->resizedAvatarUrl) ?? null,
        ];
    }
}
