<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function get()
    {
        return \App\Todo::orderBy('id', 'desc')
            ->where('author_id', '=', Auth::id())
            ->get();
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
        return $todo;
    }

    public function update(Request $request)
    {
        $this->validate($request, Todo::$rules);

        $todo = Todo::find($request->id);

        $todo['author_id'] = $request->id;
        $todo['status'] = $request->status;
        $todo['deadline'] = $request->deadline;
        $todo['planed_time'] = $request->planed_time;
        $todo['actual_time'] = $request->actual_time;
        $todo['body'] = $request->body;

        $todo->save();
        return $todo;
    }
}
