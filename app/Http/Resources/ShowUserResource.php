<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class ShowUserResource extends JsonResource
{
    #[OA\Schema(
        schema: "ShowUserResource",
        title: "ShowUser",
        description: "Пользователь",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "login", type: "string", example: "johndoe"),
            new OA\Property(property: "email", type: "string", example: "johndoe@test.com"),
            new OA\Property(property: "avatar_original", type: "string", example: "https://example.com/avatar.jpg", nullable: true),
            new OA\Property(property: "role", type: "integer", example: 1),
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'login' => $this->resource->login,
            'email' => $this->resource->email,
            'avatar_original' => $this->resource->avatarUrl,
            'role' => $this->resource->role,
        ];
    }
}
