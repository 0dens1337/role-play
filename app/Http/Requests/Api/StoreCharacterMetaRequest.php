<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class StoreCharacterMetaRequest extends FormRequest
{
    #[OA\Schema(
        schema: "StoreCharacterMetaRequest",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "character_id", type: "integer", example: 1),
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
            'character_id' => 'required|exists:characters,id',
            'likes' => 'nullable|string',
            'dislikes' => 'nullable|string',
            'text_color' => 'nullable|string',
            'background_color' => 'nullable|string',
            'accent_color' => 'nullable|string',
        ];
    }
}
