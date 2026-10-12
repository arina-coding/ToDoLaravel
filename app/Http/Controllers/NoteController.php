<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class NoteController extends Controller
{
    private array  $categories=[
            'personal' => 'Личное',
            'work' => 'Работа',
            'study' => 'Учеба',
        ];

    /* dashboard*/
    public function index(Request $request)
    {
        $active=Note::where('user_id', auth()->id())
            ->where('status', 'Новая')
            ->count();

        $completed=Note::where('user_id', auth()->id())
            ->where('status', 'Выполнена')
            ->count();

        $all=Note::where('user_id', auth()->id())
            ->count();

        $filter= $request->input('filter', 'all');
        $search= $request->input('search', '');

        $query=Note::where('user_id', auth()->id());

        if($filter === 'active'){
            $query->where('status', 'Новая');
        }elseif($filter === 'completed'){
            $query->where('status', 'Выполнена');
        }

        if($search !== ''){
            $query->where( function ($q) use($search){
                $q->where('name', 'like', "%$search%")
                    ->orWhere('text', 'like', "%$search%");
            });
        }

        $notes = $query->orderBy('id', 'desc')->paginate(3);

        if($request->expectsJson()){
            return response(
                view('notes._list', ['notes'=> $notes])->render()
            );
        }
        return view('notes.index', [
            'notes' => $notes,
            'categories' => $this->categories,
            'active' => $active,
            'completed' => $completed,
            'all' => $all,
            'filter' => $filter,
            'search' => $search,
        ]);
    }

    /* Показать форму*/
    public function create()
    {
        return view('notes.create', ['categories' => $this->categories]);
    }

    /* Сохранить данные*/
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'max:255'],
            'text'=>['nullable'],
            'category' => ['required', Rule::in(array_keys($this->categories))],
        ]);

        Note::create([
                'name'=>$request->input('name'),
                'text'=>$request->input('text'),
                'category'=>$request->input('category'),
                'status'=>'Новая',
                'user_id'=> auth()->id(),
            ]);

        return redirect()->route('notes.index');
    }

    //показать форму редактирования
    public function edit(string $id)
    {
        $note=Note::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return view('notes.edit', [
            'note' => $note,
            'categories' => $this->categories,]);
    }

    // изменит данные
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>['required', 'max:255'],
            'text'=>['nullable'],
            'category' => ['required', Rule::in(array_keys($this->categories))],
        ]);
        $note=Note::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $note->update([
            'name'=> $request->input('name'),
            'text'=>$request->input('text'),
            'category'=>$request->input('category'),
        ]);

        return redirect()->route('notes.index');
    }

    // удалить заметку
    public function destroy(string $id)
    {
        $note=Note::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $note->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function toggle(string $id){
        $note=Note::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        if($note->status === 'Новая'){
            $note->update(['status' => 'Выполнена']);
        }elseif($note->status === 'Выполнена'){
            $note->update(['status' => 'Новая']);
        }

        return response()->json([
            'success'=> true,
            'status'=> $note->status,
        ]);
    }
}
