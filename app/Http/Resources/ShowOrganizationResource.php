<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class ShowOrganizationResource extends JsonResource
{
    #[OA\Schema(
        schema: "ShowOrganizationResource",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "name", type: "string", example: "johndoe"),
            new OA\Property(property: "description", type: "string", example: "johndoe@test.com"),
            new OA\Property(property: "open", type: "integer", example: 1,),
            new OA\Property(property: "logo",  type: "string", example: "https://example.com/avatar.jpg"),
            new OA\Property(property: "parent_id", type: "integer", example: 1),
            new OA\Property(property: "children", type: "array", items: new OA\Items(ref: "#/components/schemas/ShowOrganizationResource"))
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'open' => $this->resource->open,
            'logo' => $this->resource->logo,
            'parent_id' => $this->resource->parent_id ?? null,
            'children' => ShowOrganizationResource::collection($this->whenLoaded('children')),
        ];
    }
}
