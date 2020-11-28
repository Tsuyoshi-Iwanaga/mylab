<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Memo;

class MemoController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function get()
    {
        return \App\Memo::orderBy('id', 'desc')
            ->where('author_id', '=', Auth::id())
            ->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, Memo::$rules);

        $memo = new Memo;

        $memo['author_id'] = Auth::id();
        $memo['category_id'] = $request->category_id;
        $memo['title'] = $request->title;
        $memo['body'] = $request->body;

        $memo->save();
        return $memo;
    }
}
