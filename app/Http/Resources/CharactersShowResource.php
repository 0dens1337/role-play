<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class CharactersShowResource extends JsonResource
{
    #[OA\Schema(
        schema: "CharactersShowResource",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "name", type: "string", example: "John Doe"),
            new OA\Property(property: "description", type: "string", example: "A brave hero"),
            new OA\Property(property: "occupation", type: "string", example: "Warrior"),
            new OA\Property(property: "age", type: "integer", example: 30),
            new OA\Property(property: "race", type: "string", example: "Human"),
            new OA\Property(property: "gender", type: "string", example: "Male"),
            new OA\Property(property: "biography", type: "string", example: "Born in..."),
            new OA\Property(property: "personality", type: "string", example: "Brave, loyal"),
            new OA\Property(property: "appearance", type: "string", example: "Tall, brown hair"),
            new OA\Property(property: "contracts", type: "array", items: new OA\Items(type: "string")),
            new OA\Property(property: "artifacts", type: "array", items: new OA\Items(type: "string")),
            new OA\Property(property: "magic_skills", type: "array", items: new OA\Items(type: "string")),
            new OA\Property(property: "non_magic_skills", type: "array", items: new OA\Items(type: "string")),
            new OA\Property(property: "user_id", type: "integer", example: 5),
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'user_id' => $this->resource->user_id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'occupation' => $this->resource->occupation,
            'age' => $this->resource->age,
            'race' => $this->resource->race,
            'gender' => $this->resource->gender,
            'biography' => $this->resource->biography,
            'personality' => $this->resource->personality,
            'appearance' => $this->resource->appearance,
            'contracts' => $this->resource->contracts,
            'artifacts' => $this->resource->artifacts,
            'magic_skills' => $this->resource->magic_skills,
            'non_magic_skills' => $this->resource->non_magic_skills,
            'just_created' => $this->resource->just_created,
            'meta' => CharacterMetaResource::make($this->whenLoaded('characterMeta')),
        ];
    }
}
