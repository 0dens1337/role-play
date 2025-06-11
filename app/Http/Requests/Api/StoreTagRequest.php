<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class StoreTagRequest extends FormRequest
{
    #[OA\Schema(
        schema: "StoreTagRequest",
        required: ["name"],
        properties: [
            new OA\Property(property: "name", type: "string", example: "quest"),
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
