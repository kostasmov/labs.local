<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|regex:/^[А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+$/u',
            'sex' => 'required',
            'birthday' => 'required|before:today',
            'phone' => 'required|regex:/^\+?[0-9]{10,15}$/',
            'age' => 'required',
            'mail' => 'required|email',
            'message' => 'required,',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => "Введите имя",
            'full_name.regex' => "Ошибка в формате имени",
            'sex.required' => "Не указан пол",
            'birthday.required' => "Не указана дата рождения",
            'birthday.before' => "Дата позже текущей",
            'phone.required' => "Не указан номер телефона",
            'phone.regex' => "Ошибка в записи номера телефона",
            'age.required' => "Не указан возраст",
            'mail.required' => "Не указана почта",
            'message.required' => "Пустое сообщение",
        ];
    }
}
