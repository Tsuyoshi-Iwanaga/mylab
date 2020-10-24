@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p><a href="/project">案件一覧→</a></p>
                    <p><a href="/project/create">案件登録→</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
