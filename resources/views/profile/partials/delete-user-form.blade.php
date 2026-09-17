<div class="section">
    <h1>Удаление аккаунта</h1>

    <p class="form-footer">
        После удаления аккаунта все ваши задачи будут безвозвратно удалены.
    </p>

    <form method="post" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        <div class="form-group">
            <label for="delete_password">Введите пароль для подтверждения</label>
            <input id="delete_password" name="password" type="password" placeholder="Пароль">
            @if ($errors->userDeletion->has('password'))
                <div class="error">{{ $errors->userDeletion->first('password') }}</div>
            @endif
        </div>

        <button class="button-add" type="submit">Удалить аккаунт</button>
    </form>
</div>