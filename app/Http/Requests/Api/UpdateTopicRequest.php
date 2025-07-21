<?php

namespace App\Http\Requests\Api;

use App\Enums\TopicTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Attributes as OA;

class UpdateTopicRequest extends FormRequest
{
    #[OA\Schema(
        schema: "UpdateTopicRequest",
        properties: [
            new OA\Property(property: "title", type: "string", example: "John the Blacksmith", nullable: true),
            new OA\Property(property: "description", type: "string", example: "Master Artisan", nullable: true),
            new OA\Property(property: "section_id", type: "integer", example: 1, nullable: true),
            new OA\Property(property: "for_everyone", type: "boolean", example: true),
            new OA\Property(property: "has_character", type: "boolean", example: true),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:5000',
            'section_id' => 'nullable|integer|exists:sections,id',
            'for_everyone' => 'nullable|boolean',
            'has_character' => 'nullable|boolean',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->for_everyone && $this->has_character) {
                $validator->errors()->add(
                    'has_character',
                    'Не может быть true, т.к. for_everyone уже true!'
                );
            }
        });
    }
}
