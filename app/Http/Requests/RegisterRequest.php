<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255|regex:/^[А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+(?: [А-ЯЁ][а-яё]+)?$/u',
            'mail' => 'required|email|max:255|unique:users,email',
            'login' => 'required|max:20|unique:users,login',
            'password' => 'required|min:4',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => "Введите имя",
            'name.regex' => "Неверный формат имени",
            'name.max' => "Имя не должно превышать 255 символов",

            'mail.required' => "Не указана почта",
            'mail.max' => "Адрес почты не должен превышать 255 символов",
            'mail.unique' => "Адрес почты уже используется",

            'login.required' => "Не указан логин",
            'login.max' => "Логин не должен превышать 20 символов",
            'login.unique' => "Логин уже используется",

            'password.required' => "Не указан пароль",
            'password.min' => "Пароль должен содержать минимум 4 символа"
        ];
    }
}
