<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class DemoteMemberRequest extends FormRequest
{
    #[OA\Schema(
        schema: "DemoteMemberRequest",
        properties: [
            new OA\Property(property: "character_id", type: "integer", example: 1),
            new OA\Property(property: "exp", type: "integer", example: 50),
        ],
    )]
    public function rules(): array
    {
        return [
            'character_id' => 'required|integer|exists:characters,id',
            'exp' => 'required|integer|between:1,400',
        ];
    }
}
