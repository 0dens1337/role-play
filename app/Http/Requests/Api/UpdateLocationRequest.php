<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class UpdateLocationRequest extends FormRequest
{
    #[OA\Schema(
        schema: "UpdateLocationRequest",
        properties: [
            new OA\Property(property: "name", type: "string", example: "quest"),
            new OA\Property(property: "quote", type: "string", example: "quest"),
            new OA\Property(property: "header", type: "string", example: "quest"),
            new OA\Property(property: "header_image", type: "string", example: "quest"),
            new OA\Property(property: "header_text", type: "string", example: "quest"),
            new OA\Property(property: "organization_id", type: "string", example: 1),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'quote' => 'nullable|string|max:200',
            'header' => 'nullable|string|max:255',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'header_text' => 'nullable|string|max:255',
            'organization_id' => 'nullable|integer|exists:organizations,id',
        ];
    }
}
