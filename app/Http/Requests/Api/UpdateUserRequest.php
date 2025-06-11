<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class UpdateUserRequest extends FormRequest
{
    #[OA\Schema(
        schema: "UpdateUserRequest",
        properties: [
            new OA\Property(
                property: "login",
                type: "string",
                maxLength: 32,
                minLength: 3,
                pattern: "^[a-zA-Z0-9_-]+$",
                example: "john_doe_123"
            ),
            new OA\Property(
                property: "email",
                type: "string",
                format: "email",
                maxLength: 255,
                example: "john@example.com"
            ),
            new OA\Property(
                property: "avatar",
                description: "Изображение (jpeg, png, jpg, gif, svg)",
                type: "string",
                format: "binary",
                nullable: true
            ),
            new OA\Property(
                property: "role",
                type: "integer",
                example: 1
            )
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'login' => 'nullable|string|min:3|max:32|alpha_dash|unique:users,login',
            'email' => 'nullable|string|email|max:255|unique:users,email',
            'password' => 'nullable|string|confirmed|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'nullable|integer'
        ];
    }
}
