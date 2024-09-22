@php use App\Models\User; @endphp

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

    @php
        $user = auth()->user();

        if (auth()->check() && $user instanceof User) {
            $fullName = $user->name;
            $nameParts = explode(' ', $fullName);

            $lastName = $nameParts[0];
            $firstName = $nameParts[1];
            $patronym = $nameParts[2] ?? null;

            $email = $user->email;
            $is_admin = $user->is_admin;
        }
    @endphp
@endsection

@section('content')
    <h1>Гостевая книга</h1>

    @if(session('success'))
        <p class="success-box">{{ session('success') }}</p>
        <hr>
    @endif

    @if (auth()->check() && $is_admin)
        <a href='{{ route('guestbook-loader') }}'>Загрузка сообщений гостевой книги</a>
    @endif

    <form method="post" action="{{ route('guestbook-form') }}" id="guestbookForm">
        @csrf

        <section>
            <label for="last_name">Фамилия:</label>
            <input id="last_name" name="last_name" style="width: 20%;" type="text"
                   class="{{ $errors->has('last_name') ? 'error-input' : '' }}"
                   value="{{ auth()->check() ? $lastName : old('last_name') }}"
                {{ auth()->check() ? 'readonly' : '' }}>

            @if ($errors->has('last_name'))
                <span class="error-message">
            {{ $errors->first('last_name') }}
        </span>
            @endif
        </section>

        <section>
            <label for="first_name">Имя:</label>
            <input id="first_name" name="first_name" style="width: 20%;" type="text"
                   class="{{ $errors->has('first_name') ? 'error-input' : '' }}"
                   value="{{ auth()->check() ? $firstName : old('first_name') }}"
                {{ auth()->check() ? 'readonly' : '' }}>

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
                   value="{{ auth()->check() ? $patronym : old('patronym') }}"
                {{ auth()->check() ? 'readonly' : '' }}>

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
                   value="{{ auth()->check() ? $email : old('mail') }}"
                {{ auth()->check() ? 'readonly' : '' }}>

            @if ($errors->has('mail'))
                <span class="error-message">
            {{ $errors->first('mail') }}
        </span>
            @endif
        </section>

        <section>
            <label for="message">Текст отзыва:</label><br>
            <textarea id="message" name="message" rows="5" cols="60"
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
