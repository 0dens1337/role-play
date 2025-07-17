<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateTopicRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'section_id' => 'required|integer|exists:sections,id',
            'for_everyone' => 'nullable|boolean',
            'has_character' => 'nullable|boolean',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->for_everyone && $this->has_character) {
                $validator->errors()->add(
                    'has_character',
                    'Не может быть true, т.к. for_everyone уже true!'
                );
            }
        });
    }
}
