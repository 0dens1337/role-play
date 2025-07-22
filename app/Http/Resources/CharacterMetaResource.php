<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class CharacterMetaResource extends JsonResource
{
    #[OA\Schema(
        schema: "CharacterMetaResource",
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
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'character_id' => $this->resource->character_id,
            'short_description' => $this->resource->short_description,
            'likes' => $this->resource->likes,
            'dislikes' => $this->resource->dislikes,
            'text_color' => $this->resource->text_color,
            'background_color' => $this->resource->background_color,
            'accent_color' => $this->resource->accent_color,
            'image' => $this->resource->avatarUrl,
        ];
    }
}
