<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'without_paginate' => 'nullable|boolean',
            'per_page' => 'nullable|integer',
            'name' => 'nullable|string',
        ];
    }
}
