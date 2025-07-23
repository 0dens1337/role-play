<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class OrganizationIndexResource extends JsonResource
{
    #[OA\Schema(
        schema: "OrganizationIndexResource",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "name", type: "string", example: "johndoe"),
            new OA\Property(property: "logo",  type: "string", example: "https://example.com/avatar.jpg"),
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'logo' => $this->resource->logo,
            'name' => $this->resource->name,
        ];
    }
}
