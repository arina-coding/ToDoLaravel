<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NoteController extends Controller
{
    private array  $categories=[
        'personal' => 'Личное',
        'work' => 'Работа',
        'study' => 'Учеба',
    ];

    public function index(Request $request)
    {
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

        $notes=$query->latest()->paginate(3);

        return response()->json(
            ['notes' => $notes,
            'categories' => $this->categories,
            'filter' => $filter,
            'search' => $search,]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'max:255'],
            'text'=>['nullable'],
            'category' => ['required', Rule::in(array_keys($this->categories))],
        ]);

        $notes= Note::create([
                'name'=>$request->input('name'),
                'text'=>$request->input('text'),
                'category'=>$request->input('category'),
                'status'=>'Новая',
                'user_id'=> auth()->id(),
            ]);

        return response()->json($notes, 201);
    }


    public function show(string $id)
    {
         $note=Note::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return response()->json($note);
    }

    public function update(Request $request, string $id)
    {
       $validated= $request->validate([
            'name'=>['required', 'max:255'],
            'text'=>['nullable'],
            'category' => ['required', Rule::in(array_keys($this->categories))],
        ]);
        $note=Note::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $note->update($validated);

        return response()->json($note);
    }

    public function destroy(string $id)
    {
       $note=Note::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $note->delete();

        return response()->json(['success' => true]);
    }
}
