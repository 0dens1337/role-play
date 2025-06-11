<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class NpcShowResource extends JsonResource
{
    #[OA\Schema(
        schema: "NpcShowResource",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "name", type: "string"),
            new OA\Property(property: "title", type: "string"),
            new OA\Property(property: "description", type: "string"),
            new OA\Property(property: "tags", type: "array", items: new OA\Items(ref: "#/components/schemas/TagResource"))
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
