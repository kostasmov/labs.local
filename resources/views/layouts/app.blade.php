<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Название страницы')</title>

    @vite(['resources/css/style.css'])
    @vite(['resources/js/date_updater.js'])

    @yield('head-scripts')
</head>

<body>
    @include('partials.navbar')

    <script>
        window.onload = function() {
            updateDateTime();
            setInterval(updateDateTime, 1000);
        };
    </script>

    <main>
        @auth
            <div class="user-info">
                Пользователь: {{ Auth::user()->name }}
            </div>
        @endauth

        @yield('content')
    </main>

    @yield('foot-scripts')
</body>

</html>
