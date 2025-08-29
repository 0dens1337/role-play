<?php

namespace App\Http\Resources;

use App\Services\DurationConvertService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class MissionShowResource extends JsonResource
{
    #[OA\Schema(
        schema: "MissionShowResource",
        properties: [
            new OA\Property(property: "id", type: "integer", example: 12),
            new OA\Property(property: "title", type: "string", example: "Спасти принцессу"),
            new OA\Property(property: "description", type: "string", example: "Миссия по спасению принцессы из замка."),
            new OA\Property(property: "duration", type: "string", example: "2 часа"),
            new OA\Property(property: "reward", type: "integer", example: 100),
            new OA\Property(property: "organization_id", type: "integer", example: 3),
            new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2025-08-29T12:00:00Z"),
            new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2025-08-29T14:00:00Z"),

            new OA\Property(
                property: "submitted_by",
                type: "array",
                items: new OA\Items(
                    properties: [
                        new OA\Property(property: "character_id", type: "integer", example: 7),
                        new OA\Property(property: "name", type: "string", example: "Геральт из Ривии"),
                        new OA\Property(property: "status", type: "string", example: "on_review"),
                        new OA\Property(property: "image_proof", type: "string", example: "proof.jpg", nullable: true),
                        new OA\Property(property: "description_proof", type: "string", example: "Принцесса спасена без потерь.", nullable: true),
                    ],
                    type: "object"
                ),
                nullable: true
            )
        ],
        type: "object"
    )]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'duration' => DurationConvertService::durationHumanize($this->resource->duration),
            'reward' => $this->resource->reward,
            'organization_id' => $this->resource->organization_id,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'submitted_by' => $this->whenLoaded('characters', function () {
                return $this->characters->map(function ($character) {
                    return [
                        'character_id' => $character->id,
                        'name' => $character->name,
                        'status' => $character->pivot->status,
                        'image_proof' => $character->pivot->image_proof,
                        'description_proof' => $character->pivot->description_proof,
                    ];
                });
            }),
        ];
    }
}
