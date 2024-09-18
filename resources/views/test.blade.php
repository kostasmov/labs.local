@extends('layouts.app')

@section('title', 'ЛР: Тест по дисциплине "Основы электротехники и электроники"')

@section('head-scripts')
    <script>
        function resetForm() {
            const form = document.querySelector('#testForm');
            form.reset()

            document.getElementById('course').value = 'ИС/б-22-1-о';
            document.getElementById('quest2').value = '';

            location.reload();
        }
    </script>
@endsection

@section('content')
    <h1>Тест по дисциплине "Основы электротехники и электроники"</h1>

    @if(session('success'))
        <p class="success-box">{{ session('success') }}</p>
        <hr>
    @elseif(old('quest1') && old('quest2') && old('quest3') && !$errors->has('full_name'))
        @if($errors->has('quest1'))
            <p class="error-box">{{ $errors->first('quest1') }}</p>
        @else
            <p class="success-box">Ответ 1 правильный</p>
        @endif

        @if($errors->has('quest2'))
            <p class="error-box">{{ $errors->first('quest2') }}</p>
        @else
            <p class="success-box">Ответ 2 правильный</p>
        @endif

        @if($errors->has('quest3'))
            <p class="error-box">{{ $errors->first('quest3') }}</p><hr>
        @else
            <p class="success-box">Ответ 3 правильный</p><hr>
        @endif
    @elseif($errors->any())
        @foreach($errors->all() as $error)
            <p class="error-box">{{ $error }}</p>
        @endforeach
        <hr>
    @endif

    <form method="post" action="{{ route('test-form') }}" id="testForm">
        @csrf

        <section>
            <label for="full_name">ФИО:</label>
            <input id="full_name" name="full_name" type="text" style="width: 20%;"
                   class="{{ $errors->has('full_name') ? 'error-input' : '' }}"
                   value="{{ old('full_name') }}">
            <br><br>

            <label for="course">Группа:</label>
            <select name="course" id="course">
                <optgroup label="3 курс">
                    <option value="ИС/б-22-1-о"
                        {{ old('course') == 'ИС/б-22-1-о' ? 'selected' : '' }}>
                        ИС/б-22-1-о
                    </option>
                    <option value="ИС/б-22-2-о"
                        {{ old('course') == 'ИС/б-22-2-о' ? 'selected' : '' }}>
                        ИС/б-22-2-о
                    </option>
                    <option value="ИС/б-22-3-о"
                        {{ old('course') == 'ИС/б-22-3-о' ? 'selected' : '' }}>
                        ИС/б-22-3-о
                    </option>
                </optgroup>
                <optgroup label="4 курс">
                    <option value="ИС/б-21-1-о"
                        {{ old('course') == 'ИС/б-21-1-о' ? 'selected' : '' }}>
                        ИС/б-21-1-о
                    </option>
                    <option value="ИС/б-21-2-о"
                        {{ old('course') == 'ИС/б-21-2-о' ? 'selected' : '' }}>
                        ИС/б-21-2-о
                    </option>
                </optgroup>
            </select>
            <hr>
        </section>

        <section>
            <p>
                <label for="quest1">Вопрос 1:</label> Какая формула описывает закон Ома?
            </p>
            <div>
                <input type="radio" id="quest1-1" name="quest1" value="1"
                    {{ old('quest1') == '1' ? 'checked' : '' }}>
                <label for="quest1-1">U = I / R</label>
            </div>
            <div>
                <input type="radio" id="quest1-2" name="quest1" value="2"
                    {{ old('quest1') == '2' ? 'checked' : '' }}>
                <label for="quest1-2">I = U / R</label>
            </div>
            <div>
                <input type="radio" id="quest1-3" name="quest1" value="3"
                    {{ old('quest1') == '3' ? 'checked' : '' }}>
                <label for="quest1-3">R = U * I</label>
            </div>
            <hr>
        </section>

        <section>
            <p>
                <label for="quest2">Вопрос 2:</label> Что такое сопротивление в электрической цепи?
            </p>
            <select name="quest2" id="quest2">
                <option value="">Выберите ответ</option>
                <option value="1" {{ old('quest2') == '1' ? 'selected' : '' }}>
                    Отрицательная энергия
                </option>
                <option value="2" {{ old('quest2') == '2' ? 'selected' : '' }}>
                    Разность потенциалов
                </option>
                <option value="3" {{ old('quest2') == '3' ? 'selected' : '' }}>
                    Превращение тока в тепло
                </option>
                <option value="4" {{ old('quest2') == '4' ? 'selected' : '' }}>
                    Единица измерения электрического заряда
                </option>
                <option value="5" {{ old('quest2') == '5' ? 'selected' : '' }}>
                    Неповиновение заряда цепи
                </option>
            </select>
            <hr>
        </section>

        <section>
            <p>
                <label for="quest3">Вопрос 3:</label> Что такое триггер?
            </p>
            <textarea id="quest3" name="quest3" rows="2" cols="50"
                      class="{{ $errors->has('quest3') ? 'error-input' : '' }}">
                {{ old('quest3') }}
            </textarea>
            <hr>
        </section>

        <section>
            <input type="submit" value="Отправить">
            <input type="button" onclick="resetForm()" value="Очистить форму">
        </section>
    </form>

    @if (count($results) > 0)
        <hr>
        <table>
            <thead>
            <tr>
                <th>ФИО</th>
                <th>Группа</th>
                <th>Вопрос 1</th>
                <th>Вопрос 2</th>
                <th>Вопрос 3</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result['full_name'] }}</td>
                    <td>{{ $result['course'] }}</td>

                    @php
                        $correct1Class = $result['correct1'] ? 'bg-success' : 'bg-error';
                        $correct2Class = $result['correct2'] ? 'bg-success' : 'bg-error';
                        $correct3Class = $result['correct3'] ? 'bg-success' : 'bg-error';
                    @endphp

                    <td class="{{ $correct1Class }}">{{ $result['quest1'] }}</td>
                    <td class="{{ $correct2Class }}">{{ $result['quest2'] }}</td>
                    <td class="{{ $correct3Class }}">{!! nl2br(e($result['quest3'])) !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
