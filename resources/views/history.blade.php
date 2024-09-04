@extends('layouts.app')

@section('title', 'ЛР: История просмотра')

@section('content')
        <h1>История просмотра</h1>

        <section>
            <h2>История текущего сеанса</h2>
            <table id="sessionHistory">
                <tr>
                    <th>Страница</th>
                    <th>Количество посещений</th>
                </tr>
            </table>

            <h2>История за всё время</h2>
            <table id="allTimeHistory">
                <tr>
                    <th>Страница</th>
                    <th>Количество посещений</th>
                </tr>
            </table>
        </section>
@endsection
