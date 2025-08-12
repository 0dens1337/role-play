<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class LocationResource extends JsonResource
{
    #[OA\Schema(
        schema: "LocationResource",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "name", type: "string", example: "Test"),
            new OA\Property(property: "quote", type: "string", example: "Test"),
            new OA\Property(property: "header", type: "string", example: "Test"),
            new OA\Property(property: "header_image", type: "string", example: "localhost/app/storage/public/..."),
            new OA\Property(property: "header_text", type: "string", example: "Test"),
            new OA\Property(property: "organization_id", type: "integer", example: 1),
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'quote' => $this->resource->quote,
            'header' => $this->resource->header,
            'header_image' => $this->resource->header_image,
            'header_text' => $this->resource->header_text,
            'organization_id' => $this->resource->organization_id ?? null,
        ];
    }
}
