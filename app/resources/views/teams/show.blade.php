@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mx-auto h5 " style="width: 18rem;">
                <div class="card-body text-center">
                    チーム詳細
                </div>
            </div>
            <div class="card">
                <div class='row justify-content-center align-items-center p-5'>
                    <img src="{{ asset('storage/'.$user['image']) }}" class="rounded-circle col-md-6" alt=" ...">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$user['name']}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{\Area::LIST[$user['area']]}}</li>
                    <li class="list-group-item">{{\Team::LIST[$user['team']]}}</li>
                </ul>
                <div class="card-body">
                    <p class="card-text">{{$user['body']}}</p>
                </div>
                <div class="card-body">
                    <a href="/games/create?id={{$user['id']}}" class='btn btn-outline-success'>試合を申し込む</a>
                </div>
            </div>
            <a href="/teams/create?id={{$user['id']}}" class="btn btn-danger mt-1">報告</a>
        </div>
    </div>
</div>
@endsection