<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class InviteCodeResource extends JsonResource
{
    #[OA\Schema(
        schema: "InviteCodeResource",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "code", type: "string", example: "test"),
            new OA\Property(property: "num_of_symbols", type: "integer", example: 4),
            new OA\Property(property: "max_uses", type: "integer", example: 10),
            new OA\Property(property: "uses", type: "integer", example: 1),
            new OA\Property(property: "expires_at", type: "string", example: '2025-08-06'),

        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'max_uses' => $this->resource->max_uses,
            'uses' => $this->resource->uses,
            'num_of_symbols' => $this->resource->num_of_symbols,
            'expires_at' => $this->resource->expires_at,
        ];
    }
}
