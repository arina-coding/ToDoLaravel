@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Восстановление пароля</h2>

    <p class="form-footer">
        Забыли пароль? Введите email, и мы отправим ссылку для сброса.
    </p>

    @if (session('status'))
        <div class="success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button class="button-add" type="submit">Отправить ссылку</button>
    </form>
</div>
@endsection