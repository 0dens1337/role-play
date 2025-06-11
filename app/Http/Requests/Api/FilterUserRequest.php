<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FilterUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'without_paginate' => 'nullable|boolean',
            'per_page' => 'nullable|integer',
            'login' => 'nullable|string|exists:users,login',
        ];
    }
}
