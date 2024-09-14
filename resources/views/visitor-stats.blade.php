@extends('layouts.app')

@section('title', 'ЛР: Учёба')

@section('content')
    <h1>Статистика посещений</h1>

    @if (count($visits) > 0)
        <table>
            <thead>
            <tr>
                <th>Время посещения</th>
                <th>Web-страница</th>
                <th>IP-адрес</th>
                <th>Имя хоста</th>
                <th>Браузер</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($visits as $visit)
                <tr>
                    <td>{{ $visit['visited_at'] }}</td>
                    <td>{{ $visit['page_url'] }}</td>
                    <td>{{ $visit['ip_address'] }}</td>
                    <td>{{ $visit['host_name'] }}</td>
                    <td>{{ $visit['browser'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Посещений не было.</p>
    @endif

    {{ $visits->links('vendor.pagination.custom') }}
@endsection
