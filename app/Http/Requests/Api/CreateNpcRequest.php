<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class CreateNpcRequest extends FormRequest
{
    #[OA\Schema(
        schema: "CreateNpcRequest",
        properties: [
            new OA\Property(property: "name", type: "string", example: "John the Blacksmith"),
            new OA\Property(property: "title", type: "string", example: "Master Artisan"),
            new OA\Property(property: "description", type: "string", example: "Cool description"),
            new OA\Property(property: "image", description: "Изображение (jpeg, png, jpg, gif, svg)", type: "string", format: "binary", nullable: true),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string'
        ];
    }
}
