<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class CreateInviteCodeRequest extends FormRequest
{
    #[OA\Schema(
        schema: "CreateInviteCodeRequest",
        properties: [
            new OA\Property(property: "code", type: "string", example: "test"),
            new OA\Property(property: "max_uses", type: "integer", example: 10),
            new OA\Property(property: "expired_at", type: "string", example: "2025-08-06"),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:150|unique:invite_codes,code',
            'max_uses' => 'required|integer|between:1,100',
            'expired_at' => 'required|date|after:today',
        ];
    }
}
