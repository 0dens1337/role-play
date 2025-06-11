<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class UpdateTagRequest extends FormRequest
{

    #[OA\Schema(
        schema: "UpdateTagRequest",
        required: ["name"],
        properties: [
            new OA\Property(property: "name", type: "string", example: "npc"),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
