@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
  <div class="dropdown">
            <button type="button" class="btn btn-secondary dropdown-toggle mb-5 p-2 mb-1 bg-info text-white" data-toggle="dropdown" aria-expanded="false">
              エリアを指定する
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">北海道</a>
              <a class="dropdown-item" href="#">東北</a>
              <a class="dropdown-item" href="#">関東</a>
              <a class="dropdown-item" href="#">近畿</a>
              <a class="dropdown-item" href="#">関西</a>
              <a class="dropdown-item" href="#">中国</a>
              <a class="dropdown-item" href="#">四国</a>
              <a class="dropdown-item" href="#">九州</a>
              <a class="dropdown-item" href="#">沖縄</a>
            </div>
        </div>
  </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card" style="width: 45rem;">
          <div class="card-body d-flex">
            <div class="col">
            <h5 class="card-title">team</h5>
            <h6 class="card-subtitle mb-2 text-muted">area</h6>
            <h7 class="card-subtitle mb-2 text-muted">memmber</h7>
            <p class="card-text">チームの紹介文がここに来ます。</p>
            <a href="{{route('teams.show',1)}}" class="card-link">詳細</a>
            <button type="button" class="btn btn-info ml-3 text-white">いいね</button>
          </div>
          <div class="col">
            <img src="" class="card-img-top rounded-circle" alt="...">
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
