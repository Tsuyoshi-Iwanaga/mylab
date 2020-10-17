@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">アサイン一覧</div>
        <div class="card-body">
          <div class="table-responsive small">
            <table class="table table-striped table-sm table-bordered" style="width: 1200px;">
              <thead class="thead-dark">
              <tr>
                <th scope="col">案件コード</th>
                <th scope="col">計上月</th>
                <th scope="col">工数確定</th>
                <th scope="col">ステータス</th>
                <th scope="col">JOBコード</th>
                <th scope="col">クライアント</th>
                <th scope="col">案件名</th>
                <th scope="col">作業者ID</th>
                <th scope="col">作業者</th>
                <th scope="col">拠点種別</th>
                <th scope="col">請求種別</th>
                <th scope="col">案件Lv</th>
                <th scope="col">単価</th>
                <th scope="col">予定工数</th>
                <th scope="col">実績工数</th>
                <th scope="col">有償稼働額</th>
              </tr>
              </thead>
              <tbody>
              @foreach($asigns as $asign)
              <tr>
                <th scope="row"><a href="{{route('project/show', ['id' => $asign->project->id])}}">FUK-{{$asign->project->group->name}}-{{$asign->project->projectCode()}}</a></th>
                <td>{{$asign->project->period->name}}</td>
                <td>{{$asign->manhours_defined()}}</td>
                <td>{{$asign->project->status->name}}</td>
                <td>{{$asign->project->jobCode}}</td>
                <td>{{$asign->project->client->name}}</td>
                <td>{{$asign->project->name}}</td>
                <td>{{$asign->worker->employee_number}}</td>
                <td>{{$asign->worker->name}}</td>
                <td>{{$asign->office()}}</td>
                <td>{{$asign->billing()}}</td>
                <td>{{$asign->grade->name}}</td>
                <td>{{$asign->grade->unit_price}}</td>
                <td>{{$asign->planed_hours}}</td>
                <td>{{$asign->actual_hours}}</td>
                <td>{{$asign->billable_amount}}</td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <p><a href="{{route('project')}}">案件一覧→</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection