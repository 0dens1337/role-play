<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class CreateMissionRequest extends FormRequest
{
    #[OA\Schema(
        schema: "CreateMissionRequest",
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
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'reward' => 'required|integer',
            'organization_id' => 'required|integer|exists:organizations,id',
        ];
    }
}
