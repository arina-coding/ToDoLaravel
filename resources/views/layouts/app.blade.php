<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main>
        <header>
            <p><a class="header-link" href="{{ route('home') }}">Главная</a></p>

            <div class="header-group">
                @auth
                    <a class="header-link" href="{{ route('notes.index') }}">Мои задачи</a>
                    <a class="header-link" href="{{ route('profile.edit') }}">Профиль</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="header-link">Выход</button>
                    </form>
                @endauth

                @guest
                    <a class="header-link" href="{{ route('login') }}">Вход</a>
                    <a class="header-link" href="{{ route('register') }}">Регистрация</a>
                @endguest
            </div>
        </header>


            @yield('content')

    </main>
</body>
</html>