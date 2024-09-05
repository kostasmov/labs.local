<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|regex:/^[А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+$/u',
            'course' => 'required',
            'quest1' => ['required', 'in:2'],
            'quest2' => ['required', 'in:3'],
            'quest3' => ['required', 'in:прибор']
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
            'quest3.required' => "Не введён Ответ 3",
            'quest1.in' => "Ответ 1 не правильный",
            'quest2.in' => "Ответ 2 не правильный",
            'quest3.in' => "Ответ 3 не правильный"
        ];
    }
}
