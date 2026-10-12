@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Создание задачи</h2>
    <a class="button-create" href="{{route('notes.index')}}">К задачам</a>

    <form method="POST" action="{{route('notes.store')}}">
        @csrf

        <div class="form-group">
            <input type="text" name="name" placeholder="Введите новую задачу">
            @error('name')
                <div class="error">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <select name="category">
                @foreach($categories as $key => $category)
                    <option value="{{$key}}">
                        {{$category}}
                    </option>
                @endforeach
            </select>
            @error('category')
                <div class="error">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <textarea name="text" placeholder="Введите текст заметки"></textarea>
            @error('text')
                <div class="error">{{$message}}</div>
            @enderror
        </div>

            <button class="button-add" type="submit">Добавить</button>
    </form>
</div>
@endsection