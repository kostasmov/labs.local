<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quest1' => 'required|in:2',
            'quest2' => 'required|in:3',
            'quest3' => 'required|in:триггер',
            'full_name' => 'required|regex:/^[А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+$/u'
        ];
    }

    public function messages(): array
    {
        return [
            'quest1.required' => "ОШИБКА РАБОТЫ КОНТРОЛЛЕРА",
            'quest2.required' => "ОШИБКА РАБОТЫ КОНТРОЛЛЕРА",
            'quest3.required' => "ОШИБКА РАБОТЫ КОНТРОЛЛЕРА",
            'full_name.required' => "ОШИБКА РАБОТЫ КОНТРОЛЛЕРА",
            'full_name.regex' => "ОШИБКА РАБОТЫ КОНТРОЛЛЕРА",
            'quest1.in' => "Ответ 1 не правильный",
            'quest2.in' => "Ответ 2 не правильный",
            'quest3.in' => "Ответ 3 не правильный (правильный - 'триггер')"
        ];
    }
}
