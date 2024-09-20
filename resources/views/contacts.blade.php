@php use App\Models\User; @endphp

@extends('layouts.app')

@section('title', 'ЛР: Контакт')

@section('head-scripts')
    <script>
        function resetForm() {
            const form = document.querySelector('#contactForm');
            form.reset();

            document.getElementById('age').value = '';

            location.reload();
        }
    </script>

    @php
        $user = auth()->user();

        if (auth()->check() && $user instanceof User) {
            $fullName = $user->name;
            $email = $user->email;
        }
    @endphp
@endsection

@section('content')
    <h1>Отправить сообщение</h1>

    @if(session('success'))
        <p class="success-box">{{ session('success') }}</p>
        <hr>
    @endif

    <form method="post" action="{{ route('contact-form') }}" id="contactForm">
        @csrf

        <section>
            <label for="full_name">ФИО:</label>
            <input id="full_name" name="full_name" style="width: 20%;" type="text"
                   class="{{ $errors->has('full_name') ? 'error-input' : '' }}"
                   value="{{ auth()->check() ? $fullName : old('full_name') }}"
                {{ auth()->check() ? 'readonly' : '' }}>

            @if ($errors->has('full_name'))
                <span class="error-message">
                    {{ $errors->first('full_name') }}
                </span>
            @endif
        </section>

        <section>
            <label for="sex">Пол:</label>
            <input name="sex" type="radio" value="male"
                {{ old('sex') == 'male' ? 'checked' : '' }}>Мужской
            <input name="sex" type="radio" value="female"
                {{ old('sex') == 'female' ? 'checked' : '' }}>Женский

            @if ($errors->has('sex'))
                <span class="error-message">
                    {{ $errors->first('sex') }}
                </span>
            @endif
        </section>

        <section>
            <label for="birthday">Дата рождения:</label>
            <input id="birthday" name="birthday" title="birthday" type="text"  readonly
                   class="{{ $errors->has('birthday') ? 'error-input' : '' }}"
                   value="{{ old('birthday') }}">

            @if ($errors->has('birthday'))
                <span class="error-message">
                    {{ $errors->first('birthday') }}
                </span>
            @endif
        </section>

        <section>
            <p>
                <label for="phone">Телефон:</label>
                <input id="phone" name="phone" type="text"
                       class="{{ $errors->has('phone') ? 'error-input' : '' }}"
                       value="{{ old('phone') }}">
            </p>

            @if ($errors->has('phone'))
                <span class="error-message">
                    {{ $errors->first('phone') }}
                </span>
            @endif
        </section>

        <section>
            <label for="age">Возраст:</label>
            <select name="age" id="age">
                <option value="">Не выбрано</option>
                <option value="Under 18"
                    {{ old('age') == 'Under 18' ? 'selected' : '' }}>
                    До 18 лет
                </option>
                <option value='18-29'
                    {{ old('age') == '18-29' ? 'selected' : '' }}>
                    18-29 лет
                </option>
                <option value='30-50'
                    {{ old('age') == '30-50' ? 'selected' : '' }}>
                    30-50 лет
                </option>
                <option value='Over 50'
                    {{ old('age') == 'Over 50' ? 'selected' : '' }}>
                    Старше 50 лет
                </option>
            </select>

            @if ($errors->has('age'))
                <span class="error-message">
                    {{ $errors->first('age') }}
                </span>
            @endif
        </section>

        <section>
            <label for="mail">E-mail:</label>
            <input id="mail" name="mail" type="email"
                   class="{{ $errors->has('mail') ? 'error-input' : '' }}"
                   value="{{ auth()->check() ? $email : old('email') }}"
                {{ auth()->check() ? 'readonly' : '' }}>

            @if ($errors->has('mail'))
                <span class="error-message">
                    {{ $errors->first('mail') }}
                </span>
            @endif
        </section>

        <section>
            <label for="message">Сообщение:</label><br>
            <textarea id="message" name="message" rows="4" cols="50"
                      class="{{ $errors->has('message') ? 'error-input' : '' }}">{{ old('message') }}</textarea>

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

@section('foot-scripts')
    @vite(['resources/js/calendar.js'])
@endsection
