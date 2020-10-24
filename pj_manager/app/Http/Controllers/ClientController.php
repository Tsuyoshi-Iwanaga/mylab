<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $clients = Client::all();
        return view('client.index', ['clients' => $clients]);
    }

    public function store(Request $request) {
        $this->validate($request, Client::$validate_rules);

        $client = new Client();
        $form = $request->all();
        unset($form['_token']);
        $client->fill($form)->save();

        return redirect('client');
    }

    public function delete() {
        return redirect('client');
    }
}
