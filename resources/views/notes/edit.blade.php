@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Редактирование задачи</h2>
    <a class="button-create" href="{{ route('notes.index')}}">К задачам</a>


    <form method="POST" action="{{route('notes.update', $note->id)}}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <input type="text" name="name" value="{{$note->name}}" placeholder="Введите текст">
            @error('name')
                <div class="error">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <select name="category">
                @foreach($categories as $key => $category)
                    <option @if($key === $note->category) selected @endif value="{{$key}}">
                        {{$category}}
                    </option>
                @endforeach
            </select>
            @error('category')
                <div class="error">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <textarea name="text" placeholder="Введите текст заметки">{{$note->text}}</textarea>
            @error('text')
                <div class="error">{{$message}}</div>
            @enderror
        </div>

            <button class="button-add" type="submit">Редактировать</button>

    </form>
</div>
@endsection