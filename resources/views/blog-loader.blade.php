@extends('layouts.app')

@section('title', 'ЛР: Загрузка сообщений блога')

@section('content')
    <h1>Мой блог</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="error-box">{{ $error }}</div>
        @endforeach
        <hr>
    @endif

    <a href='{{ route('blog') }}'>Вернуться</a>

    <form action="{{ route('blog-upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <p><b>Выберите .csv файл:</b>
                <input class="clickable" type="file" name="file" id="file" accept=".csv" required></p>
        </div>
        <button class="clickable" type="submit">Загрузить данные</button>
    </form>
@endsection
