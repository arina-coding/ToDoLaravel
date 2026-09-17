<div class="section">
    <h1>Информация профиля</h1>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        @if (session('status') === 'profile-updated')
            <div class="success">Сохранено</div>
        @endif

        <div class="form-group">
            <label for="name">Имя</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button class="button-add" type="submit">Сохранить</button>


    </form>
</div>