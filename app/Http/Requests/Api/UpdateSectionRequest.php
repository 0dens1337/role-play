<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string:max:50',
            'short_description' => 'nullable|string:max:100',
        ];
    }
}
