<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class CreateCharacterRequest extends FormRequest
{
    #[OA\Schema(
        schema: "CreateCharacterRequest",
        properties: [
            new OA\Property(property: "user_id", type: "integer", example: 1),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
