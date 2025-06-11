<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FilterTagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'without_paginate' => 'nullable|boolean',
            'per_page' => 'nullable|integer',
        ];
    }
}
