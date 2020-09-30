<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $user = Auth::user();
        $data = ['user' => $user];
        $projects = DB::select('select * from projects');
        return view('project.index', ['user' => $user, 'projects' => $projects]);
    }

    public function store(Request $request) {
        $validate_rule = [
            'projectCode'=>'required',
            'jobCode'=>'required',
            'name'=>'required',
            'client'=>'required',
            'director'=>'required',
            'assigner'=>'required',
            'worker'=>'required',
            'amount'=>'required',
            'estimatedTime'=>'required',
        ];
        $this->validate($request, $validate_rule);
        $params = [
            'projectCode'=>$request->projectCode,
            'jobCode'=>$request->jobCode,
            'name'=>$request->name,
            'client'=>$request->client,
            'director'=>$request->director,
            'assigner'=>$request->assigner,
            'worker'=>$request->worker,
            'amount'=>$request->amount ,
            'estimatedTime'=>$request->estimatedTime,
        ];
        DB::insert('insert into projects(projectCode, jobCode, name, client, director, assigner, worker, amount, estimatedTime) values (:projectCode, :jobCode, :name, :client, :director, :assigner, :worker, :amount, :estimatedTime)', $params);
        return redirect('project');
    }

    public function create(Request $request) {
        return view('project.create');
    }
}
