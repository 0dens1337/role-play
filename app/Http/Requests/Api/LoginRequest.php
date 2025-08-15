<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class LoginRequest extends FormRequest
{
    #[OA\Schema(
        schema: "LoginRequest",
        properties: [
            new OA\Property(property: "email", type: "string", format: "email", example: "arinashalkevich@gmail.com"),
            new OA\Property(property: "password", type: "string", format: "password", example: "password"),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string'
        ];
    }
}
