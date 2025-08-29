<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class SendMissionToReviewRequest extends FormRequest
{
    #[OA\Schema(
        schema: "SendMissionToReviewRequest",
        properties: [
            new OA\Property(property: "description_proof", type: "string", example: "test"),
            new OA\Property(property: "image_proof", description: "Изображение как доказательство выполнения", type: "string", format: "binary", nullable: true),
            new OA\Property(property: "character_id", type: "integer", example: 1),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'character_id' => 'required|integer|exists:characters,id',
            'image_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description_proof' => 'nullable|string',
        ];
    }
}
