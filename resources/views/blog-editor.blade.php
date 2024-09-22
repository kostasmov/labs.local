@extends('layouts.app')

@section('title', 'ЛР: Редактор блога')

@section('head-scripts')
    <script>
        function resetForm() {
            const form = document.querySelector('#blogForm');
            form.reset();

            location.reload();
        }
    </script>
@endsection

@section('content')
    <h1>Мой блог</h1>

    <a href='{{ route('blog') }}'>Вернуться</a>

    <form method="post" action="{{ route('blog-form') }}" id="blogForm" enctype="multipart/form-data">
        @csrf

        <section>
            <label for="theme">Тема:</label>
            <input id="theme" name="theme" style="width: 30%;" type="text"
                   class="{{ $errors->has('theme') ? 'error-input' : '' }}"
                   value="{{ old('theme') }}">

            @if ($errors->has('theme'))
                <span class="error-message">
                    {{ $errors->first('theme') }}
                </span>
            @endif
        </section>

        <section>
            <label for="image">Изображение:</label>
            <input class="clickable" type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
        </section>

        <section>
            <label for="message">Текст сообщения:</label><br>
            <textarea id="message" name="message" rows="10" cols="100"
                      class="{{ $errors->has('message') ? 'error-input' : '' }}">{{ old('message') }}</textarea>

            @if ($errors->has('message'))
                <span class="error-message">
                    {{ $errors->first('message') }}
                </span>
                <br>
            @endif
        </section>

        <input class="clickable" type="submit" value="Отправить">
        <input class="clickable" type="button" onclick="resetForm()" value="Очистить форму">
    </form>
@endsection
