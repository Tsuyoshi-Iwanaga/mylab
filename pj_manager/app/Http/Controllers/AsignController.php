<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Asign;

class AsignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $asigns = Asign::all();
        return view('asign.index', [
            'asigns' => $asigns,
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, Asign::$validate_rules);

        $asign = new Asign();
        $form = $request->all();
        unset($form['_token']);
        $asign->fill($form)->save();
        
        return redirect('asign');
    }
}
