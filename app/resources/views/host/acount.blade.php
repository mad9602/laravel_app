@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto h5 " style="width: 18rem;">
        <div class="card-body text-center">
            アカウント管理
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 45rem;">
                <div class="card-body d-flex">
                    <div class="col">
                        <h3 class='mt-3'>チーム名：</h3>
                        <h5 class="card-title">{{$user->name}}</h5>
                        <h3 class='mt-3'>報告文：</h3>
                        @foreach($user->delcount as $val)
                        <h5 class="card-title">{{$val->report}}</h5>
                        @endforeach
                    </div>
                    @if(count($user->delcount) >= 3)
                    <form action="{{route('user.delete', $user['id']) }}" method='post'>
                        @csrf
                        <input type="submit" name="delete" value="削除" onClick='return confirm("削除しますか？");'>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>


    @endsection