@extends('layouts.app')

@section('title', 'ЛР: Гостевая книга')

@section('head-scripts')
    <script>
        function resetForm() {
            const form = document.querySelector('#guestbookForm');
            form.reset();

            location.reload();
        }
    </script>
@endsection

@section('content')
    <h1>Гостевая книга</h1>

    @if(session('success'))
        <p class="success-box">{{ session('success') }}</p>
        <hr>
    @endif

    <a href='{{ route('guestbook-loader') }}'>Загрузка сообщений гостевой книги</a>

    <form method="post" action="{{ route('guestbook-form') }}" id="guestbookForm">
        @csrf

        <section>
            <label for="last_name">Фамилия:</label>
            <input id="last_name" name="last_name" style="width: 20%;" type="text"
                   class="{{ $errors->has('last_name') ? 'error-input' : '' }}"
                   value="{{ old('last_name') }}">

            @if ($errors->has('last_name'))
                <span class="error-message">
                    {{ $errors->first('last_name') }}
                </span>
            @endif
        </section>

        <section>
            <label for="first_name">Имя: </label>
            <input id="first_name" name="first_name" style="width: 20%;" type="text"
                   class="{{ $errors->has('first_name') ? 'error-input' : '' }}"
                   value="{{ old('first_name') }}">

            @if ($errors->has('first_name'))
                <span class="error-message">
                    {{ $errors->first('first_name') }}
                </span>
            @endif
        </section>

        <section>
            <label for="patronym">Отчество:</label>
            <input id="patronym" name="patronym" style="width: 20%;" type="text"
                   class="{{ $errors->has('patronym') ? 'error-input' : '' }}"
                   value="{{ old('patronym') }}">

            @if ($errors->has('patronym'))
                <span class="error-message">
                    {{ $errors->first('patronym') }}
                </span>
            @endif
        </section>

        <section>
            <label for="mail">E-mail:</label>
            <input id="mail" name="mail" type="email"
                   class="{{ $errors->has('mail') ? 'error-input' : '' }}"
                   value="{{ old('mail') }}">

            @if ($errors->has('mail'))
                <span class="error-message">
                    {{ $errors->first('mail') }}
                </span>
            @endif
        </section>

        <section>
            <label for="message">Текст отзыва:</label><br>
            <textarea id="message" name="message" rows="5" cols="60"
                      class="{{ $errors->has('message') ? 'error-input' : '' }}">
                {{ old('message') }}
            </textarea>

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

    <hr>

    @if (count($messages) > 0)
        <table>
            <thead>
            <tr>
                <th>ФИО</th>
                <th>E-mail</th>
                <th>Сообщение</th>
                <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message['name'] }}</td>
                    <td>{{ $message['email'] }}</td>
                    <td>{!! nl2br(e($message['message'])) !!}</td>
                    <td>{{ $message['date']->format('d-m-Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Сообщений нет.</p>
    @endif


@endsection
