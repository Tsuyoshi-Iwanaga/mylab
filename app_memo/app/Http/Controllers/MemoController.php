<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Memo;

class MemoController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, Memo::$rules);

        $memo = new Memo;

        $memo['author_id'] = Auth::id();
        $memo['category_id'] = $request->category_id;
        $memo['title'] = $request->title;
        $memo['body'] = $request->body;

        $memo->save();
        return redirect('home');
    }

    public function update(Request $request, $id)
    {
        return redirect('home');
    }

    public function destroy($id)
    {
        return redirect('home');
    }
}
