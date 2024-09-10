<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title', 'Название страницы')</title>
    <script src="{{ asset('scripts/date_updater.js') }}"></script>
    @yield('head-scripts')
</head>

<body>
    @include('partials.navbar')

    <script>
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>

    <main>
        @yield('content')
    </main>

    @yield('foot-scripts')
    <script src="{{ asset('scripts/drop_menu.js') }}"></script>
</body>

</html>
