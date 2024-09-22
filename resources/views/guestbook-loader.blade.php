@extends('layouts.app')

@section('title', 'ЛР: Загрузка сообщений блога')

@section('content')
    <h1>Гостевая книга</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="error-box">{{ $error }}</div>
        @endforeach
        <hr>
    @endif

    <a href='{{ route('guestbook') }}'>Вернуться</a>

    <form action="{{ route('guestbook-upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <p><b>Выберите .inc файл:</b>
            <input class="clickable" type="file" name="file" id="file" accept=".inc" required></p>
        </div>
        <button class="clickable" type="submit">Загрузить данные</button>
    </form>
@endsection
