<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class UpdateCharacterMetaRequest extends FormRequest
{
    #[OA\Schema(
        schema: "UpdateCharacterMetaRequest",
        properties: [
            new OA\Property(
                property: "image",
                description: "Аватар персонажа (изображение в формате jpeg, png, jpg, макс. размер 2MB)",
                type: "string",
                format: "binary"
            ),
            new OA\Property(property: "short_description", type: "string", example: "dsadsadsadsa"),
            new OA\Property(property: "likes", type: "string", example: "dsadsadsadsa"),
            new OA\Property(property: "dislikes", type: "string", example: "sadsadsadasdsa"),
            new OA\Property(property: "text_color", type: "string", example: "ADLSJDA"),
            new OA\Property(property: "background_color", type: "string", example: "dsadsad"),
            new OA\Property(property: "accent_color", type: "string", example: "dasdsadsa"),

        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'short_description' => 'nullable|string',
            'likes' => 'nullable|string',
            'dislikes' => 'nullable|string',
            'text_color' => 'nullable|string',
            'background_color' => 'nullable|string',
            'accent_color' => 'nullable|string',
        ];
    }
}
