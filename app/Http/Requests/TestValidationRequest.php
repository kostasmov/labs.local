<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestValidationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|regex:/^[А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+(?: [А-ЯЁ][а-яё]+)?$/u',
            'course' => 'required',
            'quest1' => 'required',
            'quest2' => 'required',
            'quest3' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => "Введите имя",
            'full_name.regex' => "Ошибка в формате имени",
            'course.required' => "Введите группу обучения",
            'quest1.required' => "Не введён Ответ 1",
            'quest2.required' => "Не введён Ответ 2",
            'quest3.required' => "Не введён Ответ 3"
        ];
    }
}
