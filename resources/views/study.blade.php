@extends('layouts.app')

@section('title', 'ЛР: Учёба')

@section('content')
    <h1>Учёба</h1>

    <section>
        <p>Севастопольский государственный университет</p>
        <p>Кафедра "Информационные системы"</p>
    </section>

    @include('partials.study-table')
@endsection
