@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">メモ投稿</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('memo.store') }}">
                        @csrf
                        <!-- category_id -->
                        <div class="form-group row">
                            <label for="category_id" class="col-md-12 col-form-label text-md-left">カテゴリ</label>
                            <div class="col-md-12 text-md-left">
                                <div class="custom-control custom-radio d-inline-block">
                                    <input type="radio" name="category_id" value="1" class="custom-control-input" id="radio-1" checked>
                                    <label class="custom-control-label" for="radio-1">その他</label>
                                </div>
                                <div class="custom-control custom-radio d-inline-block">
                                    <input type="radio" name="category_id" value="2" class="custom-control-input" id="radio-2">
                                    <label class="custom-control-label" for="radio-2">キャリア</label>
                                </div>
                                <div class="custom-control custom-radio d-inline-block">
                                    <input type="radio" name="category_id" value="3" class="custom-control-input" id="radio-3">
                                    <label class="custom-control-label" for="radio-3">家族</label>
                                </div>
                                <div class="custom-control custom-radio d-inline-block">
                                    <input type="radio" name="category_id" value="4" class="custom-control-input" id="radio-4">
                                    <label class="custom-control-label" for="radio-4">プログラミング</label>
                                </div>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- title -->
                        <div class="form-group row">
                            <label for="title" class="col-md-12 col-form-label text-md-left">タイトル</label>
                            <div class="col-md-12">
                                <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- body -->
                        <div class="form-group row">
                            <label for="body" class="col-md-12 col-form-label text-md-left">本文</label>
                            <div class="col-md-12">
                                <textarea id="body" type="body" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ old('body') }}" required autocomplete="body" autofocus style="height: 20em;"></textarea>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- submit -->
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-md-left">
                                <button type="submit" class="btn btn-primary">メモを書き込む</button>
                            </div>
                        </div>
                    </form>
                </div>
                @if(count($memos) > 0)
                    <div class="col-md-12 text-md-left">
                        @foreach($memos as $memo)
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong>{{ $memo->title }}</strong> / {{ $memo->author_id }} / {{ $memo->category_id }} / {{ $memo->created_at }}
                                </div>
                                <div class="card-body">{!! nl2br($memo->body) !!}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">サイドバー</div>
                <div class="card-body">コンテンツ</div>
            </div>
        </div>
    </div>
</div>
@endsection
