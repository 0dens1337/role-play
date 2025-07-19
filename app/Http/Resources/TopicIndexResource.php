<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class TopicIndexResource extends JsonResource
{
    #[OA\Schema(
        schema: "TopicIndexResource",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "title", type: "string", example: "Test"),
            new OA\Property(property: "section_id", type: "integer", example: 1),
            new OA\Property(property: "type", type: "integer", example: 1),
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'section_id' => $this->resource->section_id,
            'type' => $this->resource->type,
            'type_name' => $this->resource->typeName,
        ];
    }
}
