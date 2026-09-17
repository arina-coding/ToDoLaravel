<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <title>{{ config('app.name', 'To Do App')}}</title>
    </head>
    <body>
        <main>
            <header>
                <a class="header-link" href="{{route('home')}}">Главная</a>

                <div class="header-group">
                    @auth
                        <a class="header-link" href="{{route('notes.index')}}">Мои задачи</a>

                        <a class="header-link" href="{{route('profile.edit')}}">Профиль</a>

                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="header-link">Выход</button>
                        </form>
                    @endauth


                    @guest
                        <a class="header-link" href="{{route('login')}}">Вход</a>

                        <a class="header-link" href="{{route('notes.index')}}">Регистрация</a>
                    @endguest
                </div>
            </header>



            @yield('content')

    </main>
        <script src="{{ asset('js/app.js')}}"></script>
    </body>
</html>