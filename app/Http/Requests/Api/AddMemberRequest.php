<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class AddMemberRequest extends FormRequest
{
    #[OA\Schema(
        schema: "AddMemberRequest",
        properties: [
            new OA\Property(property: "character_ids", type: "array", items: new OA\Items(type: "integer"), example: [1, 2, 3]),
        ],
        type: "object",
        example: ["character_ids" => [1, 2, 3]]
    )]
    public function rules(): array
    {
        return [
            'character_ids' => 'required|array',
            'character_ids.*' => 'required|integer|exists:characters,id',
        ];
    }
}
