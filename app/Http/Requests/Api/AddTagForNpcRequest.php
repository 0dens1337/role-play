<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class AddTagForNpcRequest extends FormRequest
{
    #[OA\Schema(
        schema: "AddTagForNpcRequest",
        required: ["tag_id"],
        properties: [
            new OA\Property(
                property: "tag_id",
                description: "ID тега, который нужно добавить NPC",
                type: "integer",
                example: 12
            )
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'tag_id' => 'required|integer|exists:tags,id',
        ];
    }
}
