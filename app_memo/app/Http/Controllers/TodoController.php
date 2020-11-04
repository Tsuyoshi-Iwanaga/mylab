<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = \App\Todo::orderBy('id', 'desc')->get();
        return view('todo', ['todos' => $todos]);
    }

    public function get()
    {
        return \App\Todo::orderBy('id', 'desc')->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, Todo::$rules);

        $todo = new Todo;

        $todo['author_id'] = Auth::id();
        $todo['status'] = $request->status;
        $todo['deadline'] = $request->deadline;
        $todo['planed_time'] = $request->planed_time;
        $todo['actual_time'] = $request->actual_time;
        $todo['body'] = $request->body;

        $todo->save();
        return redirect('todo');
    }
}
