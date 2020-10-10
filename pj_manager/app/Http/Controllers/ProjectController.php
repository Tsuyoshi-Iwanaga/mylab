<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\Client;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $user = Auth::user();
        $projects = Project::all();
        return view('project.index', ['user' => $user, 'projects' => $projects]);
    }

    public function store(Request $request) {
        $this->validate($request, Project::$validate_rules);

        $project = new Project();
        $form = $request->all();
        unset($form['_token']);
        $project->fill($form)->save();

        return redirect('project');
    }

    public function create(Request $request) {
        $user = Auth::user();
        $clients = Client::all();
        return view('project.create', ['user' => $user, 'clients' => $clients]);
    }

    public function edit(Request $request) {
        $item = Project::find($request->id);
        $clients = Client::all();
        if(!isset($item)) {
            return redirect('project');
        }
        return view('project.edit', ['item' => $item, 'clients' => $clients]);
    }

    public function update(Request $request) {
        $this->validate($request, Project::$validate_rules);

        $project = Project::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $project->fill($form)->save();

        return redirect('project');
    }

    public function delete(Request $request) {
        $project = Project::find($request->id)->delete();
        return redirect('project');
    }
}
