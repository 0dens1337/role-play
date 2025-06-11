<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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
            new OA\Property(property: "email", type: "string", format: "email", example: "john@example.com"),
            new OA\Property(property: "avatar", type: "string", example: "https://example.com/avatar.jpg", nullable: true),
            new OA\Property(property: "role", type: "string", example: "admin"),
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'role' => $this->role,
        ];
    }
}
