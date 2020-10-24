@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">案件登録</div>
        <div class="card-body">
          <form method="POST" action="{{ route('project/store') }}">
            @csrf
            <!-- group -->
            <div class="form-group row">
              <label for="group" class="col-md-4 col-form-label text-md-right">案件種別</label>
              <div class="col-md-6">
                <select class="form-control @error('group') is-invalid @enderror" name="group_id" required autocomplete="group" autofocus>
                  <option value=""></option>
                  @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->name}}</option>
                  @endforeach
                </select>
                @error('group')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- period -->
            <div class="form-group row">
              <label for="period" class="col-md-4 col-form-label text-md-right">計上月</label>
              <div class="col-md-6">
                <select class="form-control @error('period') is-invalid @enderror" name="period_id" required autocomplete="period" autofocus>
                  <option value=""></option>
                  @foreach($periods as $period)
                    <option value="{{$period->id}}">{{$period->name}}</option>
                  @endforeach
                </select>
                @error('period')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- jobCode -->
            <div class="form-group row">
              <label for="jobCode" class="col-md-4 col-form-label text-md-right">JOBコード</label>
              <div class="col-md-6">
                <input id="jobCode" type="text" class="form-control @error('jobCode') is-invalid @enderror" name="jobCode" value="{{ old('jobCode') }}" required autocomplete="jobCode" autofocus>
                @error('jobCode')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- client -->
            <div class="form-group row">
              <label for="client" class="col-md-4 col-form-label text-md-right">クライアント</label>
              <div class="col-md-6">
                <select class="form-control @error('client') is-invalid @enderror" name="client_id" required autocomplete="client" autofocus>
                  <option value=""></option>
                  @foreach($clients as $client)
                    <option value="{{$client->id}}">{{$client->name}}</option>
                  @endforeach
                </select>
                @error('client')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- name -->
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">案件名</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- branch -->
            <div class="form-group row">
              <label for="branch" class="col-md-4 col-form-label text-md-right">依頼元</label>
              <div class="col-md-6">
                <select class="form-control @error('branch') is-invalid @enderror" name="branch_id" required autocomplete="branch" autofocus>
                  <option value=""></option>
                  @foreach($branches as $branch)
                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                  @endforeach
                </select>
                @error('branch')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- director -->
            <div class="form-group row">
              <label for="director" class="col-md-4 col-form-label text-md-right">依頼者</label>
              <div class="col-md-6">
                <input id="director" type="text" class="form-control @error('director') is-invalid @enderror" name="director" value="{{ old('director') }}" required autocomplete="director" autofocus>
                @error('director')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- director_email -->
            <div class="form-group row">
              <label for="director_email" class="col-md-4 col-form-label text-md-right">依頼者連絡先</label>
              <div class="col-md-6">
                <input id="director_email" type="text" class="form-control @error('director_email') is-invalid @enderror" name="director_email" value="{{ old('director_email') }}" required autocomplete="director_email" autofocus>
                @error('director_email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- assigner -->
            <div class="form-group row">
              <label for="assigner" class="col-md-4 col-form-label text-md-right">アサイン担当</label>
              <div class="col-md-6">
                <input id="assigner" type="text" class="form-control @error('assigner') is-invalid @enderror" name="assigner" value="{{ $user->name }}" required autocomplete="assigner" autofocus>
                @error('assigner')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- status -->
            <div class="form-group row">
              <label for="status" class="col-md-4 col-form-label text-md-right">ステータス</label>
              <div class="col-md-6">
                <select class="form-control @error('status') is-invalid @enderror" name="status_id" required autocomplete="status" autofocus>
                  <option value=""></option>
                  @foreach($statuses as $status)
                    <option value="{{$status->id}}">{{$status->name}}</option>
                  @endforeach
                </select>
                @error('status')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- note -->
            <div class="form-group row">
              <label for="note" class="col-md-4 col-form-label text-md-right">備考</label>
              <div class="col-md-6">
                <input id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('note') }}" required autocomplete="note" autofocus>
                @error('note')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">登録</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection