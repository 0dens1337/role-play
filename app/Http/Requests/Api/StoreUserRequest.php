<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class StoreUserRequest extends FormRequest
{

    #[OA\Schema(
        schema: "StoreUserRequest",
        required: ["login", "email", "password", "role"],
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
                property: "password",
                type: "string",
                format: "password",
                minLength: 8,
                example: "StrongP@ssw0rd"
            ),
            new OA\Property(
                property: "password_confirmation",
                type: "string",
                format: "password",
                example: "StrongP@ssw0rd"
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
            'login' => 'required|string|min:3|max:32|alpha_dash|unique:users,login',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required|integer'
        ];
    }
}
