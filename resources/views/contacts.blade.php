@extends('layouts.app')

@section('title', 'ЛР: Контакт')

@section('content')
    <h1>Отправить сообщение</h1>

    <form method=post action="mailto: kostasmov@mail.ru" id="contactForm">
        <p>
            <b>Фамилия Имя Отчество: </b>
            <input id="full_name" name="full_name" style="width: 20%;" type="text">
            <span class="error" id="full_name-error"></span>
        </p>

        <p>
            <b>Пол: </b>
            <input name="sex" type="radio" value="Мужской" required>Мужской
            <input name="sex" type="radio" value="Женский" required>Женский
            <span class="error" id="sex-error"></span>
        </p>

        <p>
            <b>Дата рождения: </b>
            <input id="birthday" name="birthday" title="birthday" type="text" readonly>
            <span class="error" id="birthday-error"></span>
        </p>

        <p>
            <b>Телефон: </b>
            <input id="phone" name="phone" type="text">
            <span class="error" id="phone-error"></span>
        </p>

        <p>
            <b>Возраст: </b>
            <select name="age" id="age">
                <option value="">Не выбрано</option>
                <option value="До 18 лет">До 18 лет</option>
                <option value="18-29 лет">18-29 лет</option>
                <option value="30-50 лет">30-50 лет</option>
                <option value="Старше 50 лет">Старше 50 лет</option>
            </select>
            <span class="error" id="age-error"></span>
        </p>

        <p>
            <b>E-mail: </b>
            <input id="mail" name="mail" type="email">
            <span class="error" id="mail-error"></span>
        </p>

        <b>Сообщение:</b><br>
        <textarea id="message" name="message" rows="4" cols="50"></textarea>
        <span class="error" id="message-error"></span>
        <br>

        <input type="submit" value="Отправить" id="submit">
        <input type="reset" value="Очистить форму">
    </form>
@endsection

@section('foot-scripts')
    <script src="{{ asset('scripts/contact-validator.js') }}"></script>
    <script src="{{ asset('scripts/calendar.js') }}"></script>
@endsection
