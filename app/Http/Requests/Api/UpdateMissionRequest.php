<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class UpdateMissionRequest extends FormRequest
{
    #[OA\Schema(
        schema: "UpdateMissionRequest",
        properties: [
            new OA\Property(property: "title", type: "string", example: "test"),
            new OA\Property(property: "description", type: "string", example: "test"),
            new OA\Property(property: "duration", type: "integer", example: 10800),
            new OA\Property(property: "reward", type: "integer", example: 100),
            new OA\Property(property: "organization_id", type: "integer", example: 1),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'reward' => 'nullable|integer',
            'organization_id' => 'nullable|integer|exists:organizations,id',
        ];
    }
}
