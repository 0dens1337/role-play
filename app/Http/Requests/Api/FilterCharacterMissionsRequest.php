<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FilterCharacterMissionsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_active' => 'nullable|boolean',
        ];
    }
}
