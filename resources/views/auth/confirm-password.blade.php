@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Подтверждение пароля</h2>

    <p class="form-footer">
        Это защищённая область. Подтвердите пароль для продолжения.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label for="password">Пароль</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button class="button-add" type="submit">Подтвердить</button>
    </form>
</div>
@endsection