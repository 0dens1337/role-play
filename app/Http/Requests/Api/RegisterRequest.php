<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class RegisterRequest extends FormRequest
{
    #[OA\Schema(
        schema: "RegisterRequest",
        properties: [
            new OA\Property(property: "login", type: "string", example: "john_doe_123"),
            new OA\Property(property: "email", type: "string", format: "email", example: "john@example.com"),
            new OA\Property(property: "password", type: "string", format: "password", example: "StrongP@ss123"),
            new OA\Property(property: "password_confirmation", type: "string", format: "password", example: "StrongP@ss123")
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'login' => 'required|string|min:3|max:32|alpha_dash|unique:users,login',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required|string',
        ];

    }
}
