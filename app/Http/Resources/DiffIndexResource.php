<?php

namespace App\Http\Resources;

use OpenApi\Attributes as OA;
use Illuminate\Http\Resources\Json\JsonResource;

class DiffIndexResource extends JsonResource
{
    #[OA\Schema(
        schema: "DiffIndexResource",
        properties: [
            new OA\Property(
                property: "character",
                ref: "#/components/schemas/CharactersResource",
                nullable: true
            ),
        ],
        type: "object"
    )]
    public function toArray($request)
    {
        return [
            'character' => CharactersResource::make($this->whenLoaded('character')),
        ];
    }
}
