<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $req, $user, $msg="no message") {
        return view('user.index', [
            'user' => $req->user,
            'msg' => $msg,
        ]);
    }

    public function post(Request $req) {
        return "<html><body><p>{$req->id}</p></body></html>";
    }
}
