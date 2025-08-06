<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class InviteCodeRequest extends FormRequest
{
    #[OA\Schema(
        schema: "InviteCodeRequest",
        properties: [
            new OA\Property(property: "code", type: "string", example: "test"),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'code' => 'required|string|exists:invite_codes,code',
        ];
    }
}
