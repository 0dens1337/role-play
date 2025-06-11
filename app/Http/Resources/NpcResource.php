<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class NpcResource extends JsonResource
{
    #[OA\Schema(
        schema: "NpcResource",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "name", type: "string", example: "John the Blacksmith"),
            new OA\Property(property: "title", type: "string", example: "Master Artisan")
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
        ];
    }
}
