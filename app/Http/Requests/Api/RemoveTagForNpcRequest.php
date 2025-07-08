<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RemoveTagForNpcRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tag_id' => 'required|integer|exists:tags,id',
        ];
    }
}
