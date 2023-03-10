@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto h5 " style="width: 18rem;">
        <div class="card-body text-center">
            チーム一覧
        </div>
    </div>
    <div class="row justify-content-center">
        <form action="{{ url('/teams') }}">
            <select class="form-select" aria-label="Default select example" name='area'>
                <option value="" selected>エリアを選択</option>
                @foreach(\Area::LIST as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </select>
            <select class="form-select m-3" aria-label="Default select example" name='team'>
                <option value="" selected>チーム人数を選択</option>
                @foreach(\Team::LIST as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-outline-light">選択</button>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($users as $user)
            @if($user['role'] ==1)
            <div class="card mb-3 bg-light" style="width: 45rem;">
                <div class="card-body d-flex">
                    <div class="col">
                        <h5 class="card-title font-weight-bold h2">{{$user['name']}}</h5>
                        <h7 class="card-subtitle mb-2 text-muted h5 m-4">{{\Team::LIST[$user['team']]}}</h7>
                        <h6 class="card-subtitle mb-2 text-muted h5 m-4">{{\Area::LIST[$user['area']]}}</h6>
                        <a href="{{route('teams.show', $user['id']) }}" class="card-link h4">詳細</a>
                        @if($like->exist(Auth::id(),$user->id))
                        <a class="toggle_wish ml-3" like_id="{{ $user->id }}" like_product="0">
                            <i style="font-size: 2rem; color: green;" class="bi bi-star-fill"></i>
                        </a>
                        @else
                        <a class="toggle_wish ml-3" like_id="{{ $user->id }}" like_product="1">
                            <i style="font-size: 2rem; color: green;" class="bi bi-star"></i>
                        </a>
                        @endif
                    </div>
                    <div class="col">
                        <img src="{{ asset('storage/'.$user['image']) }}" class="card-img-top rounded-circle" alt="...">
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @endsection