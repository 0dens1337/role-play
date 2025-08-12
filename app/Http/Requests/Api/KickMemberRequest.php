<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class KickMemberRequest extends FormRequest
{
    #[OA\Schema(
        schema: "KickMemberRequest",
        properties: [
            new OA\Property(property: "character_id", type: "integer", example: 1),
        ],
        type: "object",
        example: ["character_ids" => [1, 2, 3]]
    )]
    public function rules(): array
    {
        return [
            'character_id' => 'required|integer|exists:characters,id',
        ];
    }
}
