@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Подтверждение email</h2>

    <p class="form-footer">
        Спасибо за регистрацию! Проверьте email — мы отправили ссылку для подтверждения.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="success">Новая ссылка отправлена на ваш email.</div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="button-add" type="submit">Отправить письмо снова</button>
    </form>

    <p class="form-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="form-footer-link">Выйти</button>
        </form>
    </p>
</div>
@endsection