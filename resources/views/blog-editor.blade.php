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
            <p><b>Тема: </b>
                <input id="theme" name="theme" style="width: 30%;" type="text"
                       class="{{ $errors->has('theme') ? 'error-input' : '' }}"
                       value="{{ old('theme') }}"></p>

            @if ($errors->has('theme'))
                <span class="error-message">
                    {{ $errors->first('theme') }}
                </span>
            @endif
        </section>

        <section>
            <p><b>Изображение:</b>
            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png"></p>
        </section>

        <section>
            <p><b>Текст сообщения:</b><br>
                <textarea id="message" name="message" rows="10" cols="100"
                          class="{{ $errors->has('message') ? 'error-input' : '' }}">{{ old('message') }}</textarea>
            </p>

            @if ($errors->has('message'))
                <span class="error-message">
                    {{ $errors->first('message') }}
                </span>
                <br>
            @endif
        </section>

        <input type="submit" value="Отправить">
        <input type="button" onclick="resetForm()" value="Очистить форму">
    </form>
@endsection
