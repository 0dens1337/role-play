<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class CreateTopicRequest extends FormRequest
{

    #[OA\Schema(
        schema: "CreateTopicRequest",
        properties: [
            new OA\Property(property: "title", type: "string", example: "John the Blacksmith", nullable: false),
            new OA\Property(property: "description", type: "string", example: "Master Artisan", nullable: false),
            new OA\Property(property: "section_id", type: "integer", example: 1, nullable: false),
            new OA\Property(property: "for_everyone", type: "boolean", example: false),
            new OA\Property(property: "has_character", type: "boolean", example: false),
            new OA\Property(property: "user_id", type: "integer", example: 1, nullable: false),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'section_id' => 'required|integer|exists:sections,id',
            'for_everyone' => 'nullable|boolean',
            'has_character' => 'nullable|boolean',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function withValidator($validator)
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
