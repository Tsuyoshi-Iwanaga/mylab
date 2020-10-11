@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">案件一覧</div>
                <div class="card-body">
                  <p>{{$user->name. ' <'. $user->email. '>'}}</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">案件コード</th>
                          <th scope="col">JOBコード</th>
                          <th scope="col">案件名</th>
                          <th scope="col">クライアント名</th>
                          <th scope="col">依頼元</th>
                          <th scope="col">アサイナー</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($projects as $project)
                        <tr>
                          <th scope="row"><a href="{{route('project/edit', ['id' => $project->id])}}">{{$project->projectCode}}</a></th>
                          <td>{{$project->jobCode}}</td>
                          <td>{{$project->name}}</td>
                          <td>{{$project->clients->name}}</td>
                          <td>{{$project->director}}</td>
                          <td>{{$project->assigner}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <p><a href="{{route('project/create')}}">案件登録→</a></p>
                  <p><a href="{{route('client')}}">クライアント一覧→</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection