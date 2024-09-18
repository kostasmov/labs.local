@extends('layouts.app')

@section('title', 'ЛР: Регистрация')

@section('content')
    <h1>Регистрация пользователя</h1>

    <form method="post" action="{{ route('register') }}" id="registerForm">
        @csrf

        <section>
            <label for="name">ФИО:</label>
            <input id="name" name="name" style="width: 20%;" type="text"
                   class="{{ $errors->has('name') ? 'error-input' : '' }}"
                   value="{{ old('name') }}">

            @if ($errors->has('name'))
                <span class="error-message">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </section>

        <section>
            <label for="mail">E-mail:</label>
            <input id="mail" name="mail" style="width: 20%;" type="email"
                   class="{{ $errors->has('mail') ? 'error-input' : '' }}"
                   value="{{ old('mail') }}">

            @if ($errors->has('mail'))
                <span class="error-message">
                    {{ $errors->first('mail') }}
                </span>
            @endif
        </section>

        <section>
            <label for="login">Логин:</label>
            <input id="login" name="login" style="width: 20%;" type="text"
                   class="{{ $errors->has('login') ? 'error-input' : '' }}"
                   value="{{ old('login') }}">

            @if ($errors->has('login'))
                <span class="error-message">
                    {{ $errors->first('login') }}
                </span>
            @endif
        </section>

        <section>
            <label for="password">Пароль:</label>
            <input id="password" name="password" style="width: 20%;" type="password"
                   class="{{ $errors->has('password') ? 'error-input' : '' }}">

            @if ($errors->has('password'))
                <span class="error-message">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </section>

        <input type="submit" value="Войти">
    </form>
@endsection
