@extends('layouts.app')

@section('title', 'ЛР: Тест по дисциплине "Основы электротехники и электроники"')

@section('head-scripts')
    <script src="{{ asset('script/test-validator.js') }}"></script>
@endsection

@section('content')
    <h1>Тест по дисциплине "Основы электротехники и электроники"</h1>

    @if(session('success'))
        <div>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('test-form') }}" id="testForm">
        @csrf

        <section>
            <p>
                Фамилия Имя Отчество:
                <input id="full_name" name="full_name" type="text" style="width: 20%;">
            </p>

            <p>
                Группа:
                <select name="course">
                    <optgroup label="3 курс">
                        <option value="ИС/б-22-1-о">ИС/б-22-1-о</option>
                        <option value="ИС/б-22-2-о">ИС/б-22-2-о</option>
                        <option value="ИС/б-22-3-о">ИС/б-22-3-о</option>
                    </optgroup>
                    <optgroup label="4 курс">
                        <option value="ИС/б-21-1-о">ИС/б-21-1-о</option>
                        <option value="ИС/б-21-2-о">ИС/б-21-2-о</option>
                    </optgroup>
                </select>
            </p>
            <hr>
        </section>

        <section>
            <p>Вопрос 1: Какая формула описывает закон Ома?</p>
            <input type="radio" name="quest1" value="1"> U = I / R<br>
            <input type="radio" name="quest1" value="2"> I = U / R<br>
            <input type="radio" name="quest1" value="3"> R = U * I<hr>
        </section>

        <section>
            <p>Вопрос 2: Что такое сопротивление в электрической цепи?</p>
            <select name="quest2">
                <option value="">Выберите ответ</option>
                <option value="1">Отрицательная энергия</option>
                <option value="2">Разность потенциалов</option>
                <option value="3">Превращение тока в тепло</option>
                <option value="4">Единица измерения электрического заряда</option>
                <option value="5">Неповиновение заряда цепи</option>
            </select>
            <hr>
        </section>

        <section>
            <p>Вопрос 3: Что такое триггер?</p>
            <textarea id="quest3" name="quest3" rows="2" cols="50"></textarea>
            <hr>
        </section>

        <section>
            <input type="submit" value="Отправить">
            <input type="reset" value="Очистить форму">
        </section>
    </form>

{{--    <script>checkTestForm()</script>--}}
@endsection
