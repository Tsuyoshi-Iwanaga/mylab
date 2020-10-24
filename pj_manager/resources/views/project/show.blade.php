@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">案件詳細</div>
        <div class="card-body">
          <p>案件種別: {{$item->group->name}}</p>
          <p>計上月: {{$item->period->name}}</p>
          <p>JOBコード: {{$item->jobCode}}</p>
          <p>クライアント: {{$item->client->name}}</p>
          <p>案件名: {{$item->name}}</p>
          <p>依頼元: {{$item->branch->name}}</p>
          <p>依頼者: {{$item->director}}</p>
          <p>依頼者連絡先: {{$item->director_email}}</p>
          <p>アサイン担当: {{$item->assigner}}</p>
          <p>ステータス: {{$item->group->name}}</p>
          <p>備考: {{$item->group->name}}</p>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">アサイン登録</div>
        <div class="card-body">
          @if(count($errors) > 0)
            @foreach($errors->all() as $error)
              {{$error}}
            @endforeach
          @endif
          <form method="POST" action="{{ route('asign/store') }}">
            @csrf
            <!-- project_id -->
            <input type="hidden" name="project_id" value="{{$item->id}}">

            <!-- group -->
            <div class="form-group row">
              <label for="group" class="col-md-4 col-form-label text-md-right">工数確定</label>
              <div class="col-md-8">
                <div class="custom-control custom-radio">
                  <input type="radio" name="is_manhours_defined" value="1" class="custom-control-input" id="radio-1" checked>
                  <label class="custom-control-label" for="radio-1">確定</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" name="is_manhours_defined" value="0" class="custom-control-input" id="radio-2">
                  <label class="custom-control-label" for="radio-2">未定</label>
                </div>
                @error('is_manhours_defined')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- worker_id -->
            <div class="form-group row">
              <label for="worker_id" class="col-md-4 col-form-label text-md-right">作業者</label>
              <div class="col-md-6">
                <select class="form-control @error('worker_id') is-invalid @enderror" name="worker_id" required autocomplete="worker_id" autofocus>
                  <option value=""></option>
                  @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name."(".$user->employee_number.")"}}</option>
                  @endforeach
                </select>
                @error('worker_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- grade_id -->
            <div class="form-group row">
              <label for="grade_id" class="col-md-4 col-form-label text-md-right">レベル</label>
              <div class="col-md-6">
                <select class="form-control @error('grade_id') is-invalid @enderror" name="grade_id" required autocomplete="grade_id" autofocus>
                  <option value=""></option>
                  @foreach($grades as $grade)
                    <option value="{{$grade->id}}">{{$grade->name."(".$grade->unit_price.")"}}</option>
                  @endforeach
                </select>
                @error('grade_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- office_id -->
            <div class="form-group row">
              <label for="office_id" class="col-md-4 col-form-label text-md-right">作業拠点</label>
              <div class="col-md-6">
                <select class="form-control @error('office_id') is-invalid @enderror" name="office_id" required autocomplete="office_id" autofocus>
                  <option value="1">near</option>
                  <option value="2">TCID</option>
                  <option value="3">TCAP</option>
                  <option value="4">TCV</option>
                </select>
                @error('office_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- billing_id -->
            <div class="form-group row">
              <label for="billing_id" class="col-md-4 col-form-label text-md-right">請求種別</label>
              <div class="col-md-6">
                <select class="form-control @error('billing_id') is-invalid @enderror" name="billing_id" required autocomplete="billing_id" autofocus>
                  <option value="1">S</option>
                  <option value="2">R</option>
                </select>
                @error('billing_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- planed_hours -->
            <div class="form-group row">
              <label for="planed_hours" class="col-md-4 col-form-label text-md-right">予定工数</label>
              <div class="col-md-2">
                <input id="planed_hours" type="text" class="form-control @error('planed_hours') is-invalid @enderror" name="planed_hours" value="{{ old('planed_hours') }}" required autocomplete="planed_hours" autofocus placeholder="8:00">
                @error('planed_hours')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- actual_hours -->
            <div class="form-group row">
              <label for="actual_hours" class="col-md-4 col-form-label text-md-right">実績工数</label>
              <div class="col-md-2">
                <input id="actual_hours" type="text" class="form-control @error('actual_hours') is-invalid @enderror" name="actual_hours" value="{{ old('actual_hours') }}" required autocomplete="actual_hours" autofocus placeholder="8:00">
                @error('actual_hours')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- billable_amount -->
            <div class="form-group row">
              <label for="billable_amount" class="col-md-4 col-form-label text-md-right">有償稼働額</label>
              <div class="col-md-2">
                <input id="billable_amount" type="text" class="form-control @error('billable_amount') is-invalid @enderror" name="billable_amount" value="{{ old('billable_amount') }}" required autocomplete="billable_amount" autofocus placeholder="50000">
                @error('billable_amount')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">アサイン登録</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection