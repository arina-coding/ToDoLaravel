<div class="section">
    <h1>Смена пароля</h1>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')


        @if (session('status') === 'password-updated')
            <div class="success">Пароль обновлён</div>
        @endif

        <div class="form-group">
            <label for="update_password_current_password">Текущий пароль</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password">
            @if ($errors->updatePassword->has('current_password'))
                <div class="error">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password">Новый пароль</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password">
            @if ($errors->updatePassword->has('password'))
                <div class="error">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation">Подтверждение пароля</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
            @if ($errors->updatePassword->has('password_confirmation'))
                <div class="error">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <button class="button-add" type="submit">Сохранить</button>

    </form>
</div>