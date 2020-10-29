@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">ToDo</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('todo.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ old('body') }}" required autocomplete="body" autofocus>
                            </div>
                            <div class="col-md-2 text-md-left">
                                <input id="planed_time" type="number" class="form-control @error('planed_time') is-invalid @enderror" name="planed_time" value="{{ old('planed_time') }}" required autocomplete="planed_time" autofocus placeholder="1h" step="0.25">
                            </div>
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="deadline" value="{{ date('Y-m-d') }}">
                            <input type="hidden" name="actual_time" value="0">
                            <!-- submit -->
                            <div class="col-md-2 text-md-left">
                                <button type="submit" class="btn btn-primary">追加</button>
                            </div>
                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('planed_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
                @if(count($todos) > 0)
                    <div class="col-md-12 text-md-left">
                        @foreach($todos as $todo)
                            <div class="card" style="margin-bottom:5px;">
                                <div class="card-body" style="padding-top:5px;padding-bottom:5px;">
                                    <span style="font-size:12px;display-inline-block;margin-right:15px;">
                                        {{ $todo->status_label() }} /
                                        {{ $todo->planed_time }} /
                                        {{ $todo->actual_time }} /
                                        {{ date('Y-m-d', strtotime($todo->deadline)) }}
                                    </span>
                                    {!! nl2br($todo->body) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">サイドバー</div>
                <div class="card-body"><a href="{{ route('memo') }}">メモ</a></div>
                <div class="card-body"><a href="{{ route('todo') }}">ToDo</a></div>
            </div>
        </div>
    </div>
</div>
@endsection
