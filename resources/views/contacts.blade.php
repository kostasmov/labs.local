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
            <b>Фамилия Имя Отчество: </b>
            <input id="full_name" name="full_name" style="width: 20%;" type="text"
                   class="{{ $errors->has('full_name') ? 'error-input' : '' }}"
                   value="{{ old('full_name') }}">

            @if ($errors->has('full_name'))
                <span class="error-message">
                    {{ $errors->first('full_name') }}
                </span>
            @endif
        </section>

        <section>
            <p><b>Пол: </b>
            <input name="sex" type="radio" value="male"
                {{ old('sex') == 'male' ? 'checked' : '' }}>Мужской
            <input name="sex" type="radio" value="female"
                {{ old('sex') == 'female' ? 'checked' : '' }}>Женский
            </p>

            @if ($errors->has('sex'))
                <span class="error-message">
                    {{ $errors->first('sex') }}
                </span>
            @endif
        </section>

        <section>
            <p><b>Дата рождения: </b>
            <input id="birthday" name="birthday" title="birthday" type="text"  readonly
                   class="{{ $errors->has('birthday') ? 'error-input' : '' }}"
                   value="{{ old('birthday') }}">
            </p>

            @if ($errors->has('birthday'))
                <span class="error-message">
                    {{ $errors->first('birthday') }}
                </span>
            @endif
        </section>

        <section>
            <p><b>Телефон: </b>
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
            <p><b>Возраст: </b>
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
            </p>

            @if ($errors->has('age'))
                <span class="error-message">
                    {{ $errors->first('age') }}
                </span>
            @endif
        </section>

        <section>
            <p><b>E-mail: </b>
            <input id="mail" name="mail" type="email"
                   class="{{ $errors->has('mail') ? 'error-input' : '' }}"
                   value="{{ old('mail') }}">
            </p>

            @if ($errors->has('mail'))
                <span class="error-message">
                    {{ $errors->first('mail') }}
                </span>
            @endif
        </section>

        <section>
            <p><b>Сообщение:</b><br>
            <textarea id="message" name="message" rows="4" cols="50"
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

@section('foot-scripts')
    <script src="{{ asset('scripts/calendar.js') }}"></script>
@endsection
