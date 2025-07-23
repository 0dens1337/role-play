<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class CreateOrganizationRequest extends FormRequest
{
    #[OA\Schema(
        schema: "CreateOrganizationRequest",
        properties: [
            new OA\Property(property: "name", type: "string", example: "John the Blacksmith"),
            new OA\Property(property: "description", type: "string", example: "Master Artisan"),
            new OA\Property(property: "open", type: "integer", example: 1),
            new OA\Property(property: "logo", description: "Изображение (jpeg, png, jpg, gif, svg)", type: "string", format: "binary", nullable: true),
            new OA\Property(property: "parent_id", type: "integer", example: 1),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'open' => 'required|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'nullable|integer|exists:organizations,id',
        ];
    }
}
