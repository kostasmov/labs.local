@php
    $user = auth()->user();
@endphp

<header id="main-header">
    <ul>
        <li><a href="{{ route('index') }}"><img width="25px" src="{{ asset('photos/logo.png') }}" alt="Логотип"></a></li>
{{--            <li><a href="{{ route('about-me') }}">Обо мне</a></li>--}}
        <li><a href="{{ route('interests') }}">Мои интересы</a></li>
{{--            <li><a href="{{ route('study') }}">Учеба</a></li>--}}
        <li><a href="{{ route('album') }}">Фотоальбом</a></li>
        <li><a href="{{ route('contacts') }}">Контакт</a></li>
        <li><a href="{{ route('test') }}">Тест</a></li>
        <li><a href="{{ route('guestbook') }}">Гостевая книга</a></li>
        <li><a href="{{ route('blog') }}">Мой блог</a></li>

        @if (auth()->check() && $user instanceof App\Models\User && $user->is_admin)
            <li><a href="{{ route('visitor-stats') }}">Статистика посещений</a></li>
        @endif

        <li><p id="currentDateTime"></p></li>
    </ul>

    <ul class="auth-buttons">
        @guest
            <li><a href="{{ route('login') }}"><b>Войти</b></a></li>
            <li><a href="{{ route('register') }}"><b>Регистрация</b></a></li>
        @else
            <li><a href="{{ route('logout') }}"><b>Выйти</b></a></li>
        @endguest
    </ul>
</header>
