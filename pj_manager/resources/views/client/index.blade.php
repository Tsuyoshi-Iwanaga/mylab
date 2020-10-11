@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">クライアント一覧</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">案件コード</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($clients as $client)
                        <tr>
                          <td>{{$client->name}}</td>
                          <td><a href="#">削除</a></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <form method="POST" action="{{ route('client/store') }}">
                      @csrf
                      <!-- client -->
                      <div class="form-group row">
                          <label for="name" class="col-md-auto col-form-label text-md-left">クライアント新規登録</label>
                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                              @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <div class="col-md-2">
                              <button type="submit" class="btn btn-primary">追加</button>
                          </div>
                      </div>
                      <p><a href="{{route('project')}}">←案件一覧</a></p>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection