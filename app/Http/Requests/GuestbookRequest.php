<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestbookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'patronym' => 'max:50',
            'mail' => 'required|email|max:30',
            'message' => 'required|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => "Введите имя",
            'first_name.string' => "Неверный формат строки",
            'last_name.required' => "Введите фамилию",
            'last_name.string' => "Неверный формат строки",
            'mail.required' => "Не указана почта",
            'message.required' => "Пустой отзыв",
            'message.max' => "Превышено число символов (500)",
            'first_name.max' => "Превышено число символов",
            'last_name.max' => "Превышено число символов",
            'mail.max' => "Превышено число символов",
            'patronym.max' => "Превышено число символов",
        ];
    }
}
