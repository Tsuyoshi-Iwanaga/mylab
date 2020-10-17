<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Project;
use App\Branch;
use App\Client;
use App\Group;
use App\Period;
use App\Status;
use App\Grade;

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
        $branches = Branch::all();
        $clients = Client::all();
        $groups = Group::all();
        $periods = Period::all();
        $statuses = Status::all();
        return view('project.create', [
            'user' => $user,
            'branches' => $branches,
            'clients' => $clients,
            'groups' => $groups,
            'periods' => $periods,
            'statuses' => $statuses,
        ]);
    }

    public function edit(Request $request) {
        $item = Project::find($request->id);
        $user = Auth::user();
        $branches = Branch::all();
        $clients = Client::all();
        $groups = Group::all();
        $periods = Period::all();
        $statuses = Status::all();
        if(!isset($item)) {
            return redirect('project');
        }
        return view('project.edit', [
            'item' => $item,
            'clients' => $clients,
            'user' => $user,
            'branches' => $branches,
            'clients' => $clients,
            'groups' => $groups,
            'periods' => $periods,
            'statuses' => $statuses,
        ]);
    }

    public function show(Request $request) {
        $item = Project::find($request->id);
        $users = User::all();
        $grades = Grade::all();
        if(!isset($item)) {
            return redirect('project');
        }
        return view('project.show', [
            'item' => $item,
            'users' => $users,
            'grades' => $grades,
        ]);
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
