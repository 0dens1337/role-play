<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class InviteCodeNumOfCharactersResource extends JsonResource
{
    #[OA\Schema(
        schema: "InviteCodeNumOfCharactersResource",
        properties: [
            new OA\Property(property: "num_of_symbols", type: "integer", example: 10),
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'num_of_symbols' => $this->resource->num_of_symbols,
        ];
    }
}
