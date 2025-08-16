<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
{
    $todos = Todo::orderBy('is_done', 'asc')   // yang belum selesai di atas
                 ->orderBy('created_at', 'desc') // terbaru di atas
                 ->get();

    return view('todo', compact('todos'));
}


    public function store(Request $request)
    {
        $request->validate(['task' => 'required|string|max:255']);
        
        Todo::create([
            'user_id' => 1, // atau 0, terserah mau diset default berapa
            'task' => $request->task,
            'is_done' => false,
        ]);

        return redirect()->route('todo');
    }

    public function toggle($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->is_done = !$todo->is_done;
        $todo->save();

        return redirect()->route('todo');
    }
}
