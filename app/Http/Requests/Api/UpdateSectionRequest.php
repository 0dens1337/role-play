<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class UpdateSectionRequest extends FormRequest
{
    #[OA\Schema(
        schema: "UpdateSectionRequest",
        properties: [
            new OA\Property(property: "name", type: "string", example: "TEST"),
            new OA\Property(property: "position", type: "integer", example: 1),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'name' => 'nullable|string:max:50',
            'position' => 'nullable|integer',
        ];
    }
}
