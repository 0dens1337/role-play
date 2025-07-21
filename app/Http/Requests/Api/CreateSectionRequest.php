<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class CreateSectionRequest extends FormRequest
{
    #[OA\Schema(
        schema: "CreateSectionRequest",
        properties: [
            new OA\Property(property: "name", type: "string", example: "TEST"),
            new OA\Property(property: "position", type: "integer", example: 1),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'name' => 'required|string:max:50',
            'position' => 'required|integer',
        ];
    }
}
