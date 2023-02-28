@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mx-auto h5 " style="width: 15rem;">
                <div class="card-body text-center">
                    チーム詳細
                </div>
            </div>
            <div class="card mx-auto" style="width: 30rem;">
                <div class='row justify-content-center align-items-center p-5'>
                    <img src="{{ asset('storage/'.$user['image']) }}" class="rounded-circle col-md-6" alt=" ...">
                </div>
                <div class="card">
                    <h3 class='mt-3 h5'>チーム名：</h3>
                    <li class="list-unstyled h4">{{$user['name']}}</li>
                </div>
                <div class="card">
                    <h3 class='mt-3 h5'>エリア：</h3>
                    <li class="list-unstyled h4">{{\Area::LIST[$user['area']]}}</li>
                </div>
                <div class="card">
                    <h3 class='mt-3 h5'>人数：</h3>
                    <li class="list-unstyled h4">{{\Team::LIST[$user['team']]}}</li>
                </div>
                <div class="card">
                    <h3 class='mt-3 h5'>紹介文：</h3>
                    <p class="card-text h4">{{$user['body']}}</p>
                </div>
                <div class="card-body mx-auto">
                    <a href="/games/create?id={{$user['id']}}" class='btn btn-outline-success'>試合を申し込む</a>
                    <a href="/teams/create?id={{$user['id']}}" class="btn btn-danger mt-1 ml-5">報告</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection