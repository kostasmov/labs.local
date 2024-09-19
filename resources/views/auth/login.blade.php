@extends('layouts.app')

@section('title', 'ЛР: Вход')

@section('content')
    <h1>Вход пользователя</h1>

    @if (session('error'))
        <p class="error-box">{{ session('error') }}</p>
        <hr>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="error-box">{{ $error }}</div>
        @endforeach
        <hr>
    @endif

    <form action="{{ route('login') }}" method="post" id="loginForm">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="login">Логин:</label>
            <input type="text" name="login" id="login" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">Войти</button>
    </form>
@endsection
