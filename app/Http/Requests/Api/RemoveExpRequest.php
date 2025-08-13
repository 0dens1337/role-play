<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class RemoveExpRequest extends FormRequest
{
    #[OA\Schema(
        schema: "RemoveExpRequest",
        properties: [
            new OA\Property(property: "exp", type: "integer", example: 500),
        ],
        type: "object"
    )]
    public function rules(): array
    {
        return [
            'exp' => 'required|integer'
        ];
    }
}
