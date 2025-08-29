<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FilterMissionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'nullable|string',
            'without_paginate' => 'nullable|boolean',
            'per_page' => 'nullable|integer',
            'by_organization' => 'nullable|integer|exists:organizations,id',
        ];
    }
}
