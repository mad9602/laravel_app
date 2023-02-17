@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
  <div class="dropdown">
            <button type="button" class="btn btn-secondary dropdown-toggle mb-5 p-2 mb-1 bg-info text-white" data-toggle="dropdown" aria-expanded="false">
              エリアを指定する
            </button>
            <div class="dropdown-menu">
            @foreach(\Area::LIST as $key => $item)
              <a class="dropdown-item" href="/teams?keyword={{$key}}">{{$item}}</a>
            @endforeach
            </div>
        </div>
  </div>
    <div class="row justify-content-center">
      <div class="col-md-8">   
        @foreach($users as $user)
        <div class="card" style="width: 45rem;">
          <div class="card-body d-flex">       
            <div class="col">
            <h5 class="card-title">{{$user['name']}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{\Area::LIST[$user['area']]}}</h6>
            <h7 class="card-subtitle mb-2 text-muted">{{\Team::LIST[$user['team']]}}</h7>
            <p class="card-text">{{$user['body']}}</p>
            <a href="{{route('teams.show', $user['id']) }}" class="card-link">詳細</a>
            <button type="button" class="btn btn-info ml-3 text-white">いいね</button>
          </div>
          <div class="col">
            <img src="{{ asset('storage/'.$user['image']) }}" class="card-img-top rounded-circle" alt="...">
          </div>
        </div>
        @endforeach
      </div>
    </div>
</div>
@endsection
