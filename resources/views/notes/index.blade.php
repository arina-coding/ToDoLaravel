@extends('layouts.tasks')

@section('content')

<div class="container">
<h2>Мои задачи</h2>

<div class="task-actions">
    <a class="button-create" href="{{ route('notes.create')}}">Создать задачу</a>

        <form method="get" action="{{route('notes.index')}}">
            <input name="filter" value="{{$filter}}" type="hidden">
            <input name="search" placeholder=' Введите поиск' value="{{$search}}">
            <button class="button-create" type="submit">Найти</button>
        </form>
</div>


<div class="filters">
    <a href="{{ route('notes.index', ['filter'=> 'all', 'search'=> $search])}}" class="filter-link @if($filter === 'all') active @endif"  >Все({{$all}})</a>
    <a href="{{ route('notes.index', ['filter'=> 'active', 'search'=> $search])}}" class="filter-link @if($filter === 'active') active @endif" >Активные( {{$active}})</a>
    <a href="{{ route('notes.index', ['filter'=> 'completed', 'search'=> $search])}}" class="filter-link @if($filter === 'completed') active @endif">Выполненные({{ $completed}})</a>
</div>

@include('notes._list', ['notes' => $notes])

<div id="notes-list">
{{$notes->links()}}
</div>

</div>
@endsection