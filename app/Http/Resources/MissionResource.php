<?php

namespace App\Http\Resources;

use App\Services\DurationConvertService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class MissionResource extends JsonResource
{
    #[OA\Schema(
        schema: "MissionResource",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 1),
            new OA\Property(property: "title", type: "string", example: "Test"),
            new OA\Property(property: "duration", type: "integer", example: 1),
            new OA\Property(property: "reward", type: "integer", example: 1),
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'duration' => DurationConvertService::durationHumanize($this->resource->duration),
            'reward' => $this->resource->reward,
        ];
    }
}
