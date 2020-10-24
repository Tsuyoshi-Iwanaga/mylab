@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">案件一覧</div>
        <div class="card-body">
          <p>{{$user->name. ' <'. $user->email. '>'}}</p>
          <div class="table-responsive small">
            <table class="table table-striped table-sm table-bordered" style="width: 1200px;">
              <thead class="thead-dark">
              <tr>
                <th scope="col">案件コード</th>
                <th scope="col">編集</th>
                <th scope="col">記入日</th>
                <th scope="col">更新日</th>
                <th scope="col">計上月</th>
                <th scope="col">JOBコード</th>
                <th scope="col">クライアント</th>
                <th scope="col">案件名</th>
                <th scope="col">依頼元</th>
                <th scope="col">依頼者</th>
                <th scope="col">依頼者連絡先</th>
                <th scope="col">アサイン担当</th>
                <th scope="col">ステータス</th>
                <th scope="col">備考</th>
              </tr>
              </thead>
              <tbody>
              @foreach($projects as $project)
              <tr>
                <th scope="row"><a href="{{route('project/show', ['id' => $project->id])}}">FUK-{{$project->group->name}}-{{$project->projectCode()}}</a></th>
                <td><a href="{{route('project/edit', ['id' => $project->id])}}">■</a></td>
                <td>{{date('Y/m/d', strtotime($project->created_at))}}</td>
                <td>{{date('Y/m/d', strtotime($project->updated_at))}}</td>
                <td>{{$project->period->name}}</td>
                <td>{{$project->jobCode}}</td>
                <td>{{$project->client->name}}</td>
                <td>{{$project->name}}</td>
                <td>{{$project->branch->name}}</td>
                <td>{{$project->director}}</td>
                <td>{{$project->director_email}}</td>
                <td>{{$project->assigner}}</td>
                <td>{{$project->status->name}}</td>
                <td>{{$project->note}}</td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <p><a href="{{route('asign')}}">アサイン一覧→</a></p>
          <p><a href="{{route('project/create')}}">案件登録→</a></p>
          <p><a href="{{route('client')}}">クライアント一覧→</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection