<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateSectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string:max:50',
            'short_description' => 'required|string:max:100',
        ];
    }
}
