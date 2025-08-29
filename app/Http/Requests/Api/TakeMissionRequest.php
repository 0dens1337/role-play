<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class TakeMissionRequest extends FormRequest
{
    #[OA\Schema(
        schema: "TakeMissionRequest",
        properties: [
            new OA\Property(property: "character_id", type: "integer", example: 1),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'character_id' => 'required|integer|exists:characters,id',
        ];
    }
}
