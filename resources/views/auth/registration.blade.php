@extends('layouts.app')

@section('title', 'ЛР: Регистрация')

@section('content')
    <h1>Регистрация пользователя</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="error-box">{{ $error }}</div>
        @endforeach
        <hr>
    @endif

{{--    <form action="{{ route('register') }}" method="post">--}}
{{--        @csrf--}}

{{--        <div class="form-group">--}}
{{--            <label for="login">Логин</label>--}}
{{--            <input type="text" name="login" id="login" class="form-control" required>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label for="password">Пароль</label>--}}
{{--            <input type="password" name="password" id="password" class="form-control" required>--}}
{{--        </div>--}}

{{--        <button type="submit">Загрузить данные</button>--}}
{{--    </form>--}}
@endsection
