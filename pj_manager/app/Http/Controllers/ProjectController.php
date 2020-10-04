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
        $projects = DB::table('projects')->get();
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
        ];
        $this->validate($request, $validate_rule);
        $params = [
            'projectCode'=>$request->projectCode,
            'jobCode'=>$request->jobCode,
            'name'=>$request->name,
            'client'=>$request->client,
            'director'=>$request->director,
            'assigner'=>$request->assigner,
        ];
        DB::table('projects')->insert($params);
        return redirect('project');
    }

    public function create(Request $request) {
        return view('project.create');
    }

    public function edit(Request $request) {
        $id = $request->id;
        $item = DB::table('projects')->where('id', $id)->first();
        if(!isset($item)) {
            return redirect('project');
        }
        return view('project.edit', ['item' => $item]);
    }

    public function update(Request $request) {
        $id = $request->id;
        $validate_rule = [
            'id' => 'required',
            'projectCode'=>'required',
            'jobCode'=>'required',
            'name'=>'required',
            'client'=>'required',
            'director'=>'required',
            'assigner'=>'required',
        ];
        $this->validate($request, $validate_rule);
        $params = [
            'projectCode'=>$request->projectCode,
            'jobCode'=>$request->jobCode,
            'name'=>$request->name,
            'client'=>$request->client,
            'director'=>$request->director,
            'assigner'=>$request->assigner,
        ];
        DB::table('projects')->where('id', $id)->update($params);
        return redirect('project');
    }

    public function delete(Request $request) {
        $id = $request->id;
        DB::table('projects')->where('id', $id)->delete();
        return redirect('project');
    }
}
