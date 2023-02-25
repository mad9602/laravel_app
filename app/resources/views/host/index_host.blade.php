@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        @foreach($query as $val)
        <div class="card" style="width: 45rem;">
            <div class="card-body d-flex">
                <div class="col">
                    <h5 class="card-title">{{$val->user->name}}</h5>
                    <a href="{{route('games.show', $val->user->id) }}" class="card-link">管理</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection