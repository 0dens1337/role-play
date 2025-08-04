<?php

namespace App\Http\Requests\Api;

use App\Enums\TopicTypeEnum;
use App\Models\Organization;
use App\Models\Section;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Attributes as OA;

class CreateTopicRequest extends FormRequest
{

    #[OA\Schema(
        schema: "CreateTopicRequest",
        properties: [
            new OA\Property(property: "title", type: "string", example: "John the Blacksmith", nullable: false),
            new OA\Property(property: "description", type: "string", example: "Master Artisan", nullable: false),
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
            'for_everyone' => 'nullable|boolean',
            'has_character' => 'nullable|boolean',
            'user_id' => 'required|integer|exists:users,id',

            'belongable_type' => 'required|string|in:App\Models\Section,App\Models\Organization',
            'belongable_id' => 'required|integer',
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

            if ($this->belongable_type && $this->belongable_id) {
                $modelClass = $this->belongable_type;
                if (!class_exists($modelClass) || !in_array($modelClass, [
                        Section::class,
                        Organization::class,
                    ])) {
                    $validator->errors()->add('belongable_type', 'Недопустимый тип модели');
                } elseif (!$modelClass::query()->where('id', $this->belongable_id)->exists()) {
                    $validator->errors()->add('belongable_id', 'Не найден объект для связи');
                }
            }
        });
    }
}
