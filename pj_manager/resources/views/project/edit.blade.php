@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">案件修正</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('project/update') }}">
                        @csrf
                        <!-- id -->
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <!-- projectCode -->
                        <div class="form-group row">
                            <label for="projectCode" class="col-md-4 col-form-label text-md-right">案件コード</label>
                            <div class="col-md-6">
                                <input id="projectCode" type="text" class="form-control @error('projectCode') is-invalid @enderror" name="projectCode" value="{{ $item->projectCode }}" required autocomplete="projectCode" autofocus>
                                @error('projectCode')
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
                                <input id="jobCode" type="text" class="form-control @error('jobCode') is-invalid @enderror" name="jobCode" value="{{ $item->jobCode }}" required autocomplete="jobCode" autofocus>
                                @error('jobCode')
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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item->name }}" rquired autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- client -->
                        <div class="form-group row">
                            <label for="client" class="col-md-4 col-form-label text-md-right">クライアント名</label>
                            <div class="col-md-6">
                                <input id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ $item->client }}"required autocomplete="client" autofocus>
                                @error('client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- director -->
                        <div class="form-group row">
                            <label for="director" class="col-md-4 col-form-label text-md-right">依頼元</label>
                            <div class="col-md-6">
                                <input id="director" type="text" class="form-control @error('director') is-invalid @enderror" name="director" value="{{ $item->director }}" required autocomplete="director" autofocus>
                                @error('director')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- assigner -->
                        <div class="form-group row">
                            <label for="assigner" class="col-md-4 col-form-label text-md-right">アサイナー</label>
                            <div class="col-md-6">
                                <input id="assigner" type="text" class="form-control @error('assigner') is-invalid @enderror" name="assigner" value="{{ $item->assigner }}" required autocomplete="assigner" autofocus>
                                @error('assigner')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">更新</button>
                            </div>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('project/delete') }}">
                      @csrf
                      <!-- id -->
                      <input type="hidden" name="id" value="{{ $item->id }}">
                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-danger">削除</button>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection