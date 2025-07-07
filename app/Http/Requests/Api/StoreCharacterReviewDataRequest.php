<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class StoreCharacterReviewDataRequest extends FormRequest
{
    #[OA\Schema(
        schema: "StoreCharacterReviewDataRequest",
        properties: [
            new OA\Property(property: "name", type: "string", example: "John the Blacksmith"),
            new OA\Property(property: "description", type: "string", example: "Cool description"),
            new OA\Property(property: "occupation", type: "string", example: "Master Artisan"),
            new OA\Property(property: "age", type: "integer", example: 100),
            new OA\Property(property: "race", type: "string", example: "Master Artisan"),
            new OA\Property(property: "gender", type: "string", example: "Master Artisan"),
            new OA\Property(property: "biography", type: "string", example: "Master Artisan"),
            new OA\Property(property: "personality", type: "string", example: "Master Artisan"),
            new OA\Property(property: "appearance", type: "string", example: "Master Artisan"),
            new OA\Property(property: "contracts", type: "string", example: "Master Artisan"),
            new OA\Property(property: "artifacts", type: "string", example: "Master Artisan"),
            new OA\Property(property: "magic_skills", type: "string", example: "Master Artisan"),
            new OA\Property(property: "non_magic_skills", type: "string", example: "Master Artisan"),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'age' => 'required|integer',
            'race' => 'nullable|string',
            'gender' => 'nullable|string',
            'biography' => 'nullable|string',
            'personality' => 'nullable|string',
            'appearance' => 'nullable|string',
            'contracts' => 'nullable|string',
            'artifacts' => 'nullable|string',
            'magic_skills' => 'nullable|string',
            'non_magic_skills' => 'nullable|string',
        ];
    }
}
