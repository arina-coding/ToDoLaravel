@if(count($notes) > 0)

<ul class="tasks" >
    @foreach($notes as $note)

        <li class="tasks-group
            @if ($note->status === 'Выполнена')
                completed
            @endif
        ">
            <div class="tasks-card">
                <div class="card">
                    <input class="checkbox" type="checkbox" data-id="{{ $note->id}}"
                        @if($note->status==='Выполнена')
                            checked
                        @endif
                    >

                    <a href="{{ route('notes.edit', $note->id)}}" class="task">
                        {{$note->name}}
                    </a>
                    <div class="text">
                        {{$note->short_text}}
                    </div>
                </div>

                    <button type="button" class="close" data-id="{{$note->id}}">
                        <img class="close-img" src="img/close.png">
                    </button>
            </div>


            <div class="tasks-card-bottom">
                <div class="card">
                    <img class="paper-clip" src="img/paper-clip.png" alt="Иконка">

                    <span class="category">
                        {{$categories[$note->category]}}
                    </span>
                </div>

                <div class="date-start"> {{$note->created_at?->format('d.m.Y')}}</div>
            </div>
        </li>
    @endforeach
        </ul>
@else
    <p class="task-empty">Список задач пуст</p>
@endif