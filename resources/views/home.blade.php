@extends('layouts.app')

@section('content')

<div class="hero-container">
    <h1 class="hero-title">Забудь про хаос в голове — управляй задачами легко!</h1>
    <p class="hero-text">Каждая выполненная задача — звезда в твоём небе. Управляй ими легко: создавай, фильтруй, находи нужное за секунду.</p>
    <a class="hero-button" href="{{route('notes.index')}}" >Попробовать</a>
</div>

<h2>Преимущества</h2>

<div class="advantage-container">

    <div class="advantage">
        <h3 class="advantage-title">Категории</h3>
        <p class="advantage-title">Разделяй задачи на личные, рабочие и учебные. Находи нужное за секунду</p>
    </div>

    <div class="advantage">
        <h3 class="advantage-title">Фильтры и поиск</h3>
        <p class="advantage-title">Показывай только активные или только выполненные. Ищи по названию и тексту</p>
    </div>

    <div class="advantage">
        <h3 class="advantage-title">Простота</h3>
        <p class="advantage-title">Создавай задачи в один клик. Никаких сложных настроек</p>
    </div>
</div>

<h2>Как приступить?</h2>

<div class="action-container">

    <div class="action">
        <div class="action-title">1</div>
        <p class="content-action">Зарегистрируйся </p>
    </div>

    <div class="action">
        <div class="action-title">2</div>
        <p class="content-action">Создай задачу</p>
    </div>

    <div class="action">
        <div class="action-title">3</div>
        <p class="content-action">Отмечай выполнение</p>
    </div>

</div>

<footer class="footer">
<p> © {{now()->year}} ToDo App</p>
</footer>

@endsection
