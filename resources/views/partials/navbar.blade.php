<header id="main-header">
    <nav>
        <ul>
            <li><a href="{{ route('index') }}"><img width="25px" src="{{ asset('photos/logo.png') }}" alt="Логотип"></a></li>
{{--            <li><a href="{{ route('about-me') }}">Обо мне</a></li>--}}
            <li class="dropdown">
                <a href="{{ route('interests') }}">Мои интересы</a>
                <ul class="dropdown-content">
                    <li><a href="{{ route('interests') }}#winter">Зима</a></li>
                    <li><a href="{{ route('interests') }}#spring">Весна</a></li>
                    <li><a href="{{ route('interests') }}#summer">Лето</a></li>
                    <li><a href="{{ route('interests') }}#autumn">Осень</a></li>
                </ul>
            </li>
{{--            <li><a href="{{ route('study') }}">Учеба</a></li>--}}
            <li><a href="{{ route('album') }}">Фотоальбом</a></li>
            <li><a href="{{ route('contacts') }}">Контакт</a></li>
            <li><a href="{{ route('test') }}">Тест</a></li>
            <li><a href="{{ route('guestbook') }}">Гостевая книга</a></li>
            <li><a href="{{ route('blog') }}">Мой блог</a></li>
            <li><a href="{{ route('visitor-stats') }}">Статистика посещений</a></li>
            <li><p id="currentDateTime"></p></li>
        </ul>
    </nav>
</header>
