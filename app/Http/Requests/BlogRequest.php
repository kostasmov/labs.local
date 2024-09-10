<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'theme' => 'required|string|max:100',
            'message' => 'required|max:1000',
            'created_at' => 'date',
        ];
    }

    public function messages(): array
    {
        return [
            'theme.required' => "Введите имя",
            'message.required' => "Блог пустой",
            'message.max' => "Превышено число символов",
            'theme.max' => "Превышено число символов"
        ];
    }
}
