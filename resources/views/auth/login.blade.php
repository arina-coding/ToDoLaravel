@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Вход</h2>

    @if (session('status'))
        <div class="success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="remember"> Запомнить меня
            </label>
        </div>

        <button class="button-add" type="submit">Войти</button>

        <p class="form-footer">
            @if (Route::has('password.request'))
                <a class="form-footer-link" href="{{ route('password.request') }}">Забыли пароль?</a>
            @endif
        </p>
    </form>
</div>
@endsection