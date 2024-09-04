@extends('layouts.app')

@section('title', 'ЛР: Главная страница')

@section('content')
    <h1>Главная страница</h1>

    <section>
        <img src="{{ asset('photos/photo.png') }}" style="float: left; margin-right: 20px;"
             width="8%" alt="Фотография" title="Кермит">
        <p><b>ФИО студента</b>: Мовенко К.М.</p>
        <p><b>Группа</b>: ИС/б-21-2-о</p>
        <p><b>Лабораторная работа 8</b>: Исследование архитектуры MVC приложения и возможностей
            обработки данных HTML-форм на стороне сервера с использованием языка PHP</p>
    </section>
@endsection
