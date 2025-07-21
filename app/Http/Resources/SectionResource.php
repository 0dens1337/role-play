<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class SectionResource extends JsonResource
{
    #[OA\Schema(
        schema: "SectionResource",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "name", type: "string", example: "Test"),
            new OA\Property(property: "position", type: "integer", example: 1),
            new OA\Property(property: "topics", type: "array",
                items: new OA\Items(ref: "#/components/schemas/TopicIndexResource")
            )
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'position' => $this->resource->position,
            'topics' => TopicIndexResource::collection($this->whenLoaded('topics')),
        ];
    }
}
