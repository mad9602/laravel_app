@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($flg == "")
            <div class="card mx-auto h5 " style="width: 18rem;">
                <div class="card-body text-center">
                    マイページ
                </div>
            </div>
            <div class="card" style="width: 45rem;">
                <div style="margin-top: 30px;">
                    <img src="{{ asset('storage/'.Auth::user()->image) }}" class="rounded mx-auto d-block profile-img" alt="...">
                    <table class="table table-striped">
                        <tr>
                            <th>氏名</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>エリア</th>
                            <td>{{\Area::LIST[Auth::user()->area]}}</td>
                        </tr>
                        <tr>
                            <th>チームの人数</th>
                            @if(Auth::user()->team == 0)
                            <td>{{"1〜10人"}}</td>
                            @elseif(Auth::user()->team == 1)
                            <td>{{"11〜30人"}}</td>
                            @else(Auth::user()->team == 2)
                            <td>{{"31人以上"}}</td>
                            @endif
                        </tr>
                        <tr>
                            <th>紹介文</th>
                            <td>{{Auth::user()->body}}</td>
                        </tr>
                    </table>
                </div>
                <a href="{{ route('teams.edit', Auth::id()) }}">
                    <button type='submit' class='btn btn-outline-secondary'>編集する</button>
                </a>
            </div>


            @elseif($flg == 1)
            <div class="card mx-auto h5 " style="width: 18rem;">
                <div class="card-body text-center">
                    マッチングリスト
                </div>
            </div>

            @if(count($matchingList) == 0 )
            <div class='card height: 20rem;'>
                <div>
                    <ul>
                        <li class='list-unstyled'>まだマッチングはありません。</li>
                    </ul>
                </div>
            </div>
            @else
            @foreach($matchingList as $value)
            <div class='card height: 20rem;'>
                <div>
                    <ul class='col h4'>
                        <div class="row float-right profile-img mr-1">
                            <img src="{{ asset('storage/'.$value->game->user->image) }}" class="card-img-top rounded-circle " alt="...">
                        </div>
                        <h3 class='mt-3'>チーム名：</h3>
                        <li class='mr-3 list-unstyled'>{{$value->game->user->name}}</li>
                        <h3 class='mt-3'>人数：</h3>
                        <li class='mr-5 list-unstyled'>{{\Team::LIST[$value->game->user->team]}}</li>
                        <h3 class='mt-3'>エリア：</h3>
                        <li class='mr-3 list-unstyled'>{{\Area::LIST[$value->game->user->area]}}</li>
                        <h3 class='mt-3'>メッセージ：</h3>
                        <li class='mr-3 list-unstyled'>{{$value->charange_text}}</li>
                    </ul>
                </div>
            </div>
            @endforeach
            @endif

            @elseif($flg == 2)
            <div class="card mx-auto h5 " style="width: 18rem;">
                <div class="card-body text-center">
                    いいねリスト
                </div>
            </div>

            @if(count($likeList) ==0 )

            <div class='card'>
                <div>
                    <ul>
                        <li class='list-unstyled  list-unstyled h4'>いいねしたチームはありません。</li>
                    </ul>
                </div>
            </div>
            @else
            @foreach($likeList as $liker)
            <div class='card'>
                <div>
                    <ul class='col h4'>
                        <div class="row float-right profile-img mr-1">
                            <img src="{{ asset('storage/'.$liker->user->image) }}" class="card-img-top rounded-circle " alt="...">
                        </div>
                        <h3 class='mt-3'>チーム名：</h3>
                        <li class='mr-3 list-unstyled'>{{$liker->user->name}}</li>
                    </ul>
                </div>
            </div>
            @endforeach
            @endif

            @elseif($flg == 3)
            <div class="card mx-auto h5 " style="width: 18rem;">
                <div class="card-body text-center h4">
                    申し込んだチーム
                </div>
            </div>

            @if(count($applyList) == 0 )
            <div class='card'>
                <div>
                    <ul>
                        <li class='list-unstyled h4'>まだ申し込んでいません。</li>
                    </ul>
                </div>
            </div>
            @else
            @foreach($applyList as $game)
            <div class='card'>
                <div>
                    <ul class='col h4'>
                        <div class="row float-right profile-img mr-1">
                            <img src="{{ asset('storage/' . $game->opponents->user->image) }}" class="card-img-top rounded-circle " alt="...">
                        </div>
                        <h3 class='mt-3'>チーム名：</h3>
                        <li class='mr-3 list-unstyled'>{{$game->opponents->user->name}}</li>
                        <h3 class='mt-3'>人数：</h3>
                        <li class='mr-5 ml-3 list-unstyled'>{{\Team::LIST[$game->opponents->user->team]}}</li>
                        <h3 class='mt-3'>エリア：</h3>
                        <li class='mr-5 ml-3 list-unstyled'>{{\Area::LIST[$game->opponents->user->area]}}</li>
                        <h3 class='mt-3'>メッセージ：</h3>
                        <li class='mr-3 list-unstyled'>{{$game->opponents->charange_text}}</li>
                    </ul>
                </div>
            </div>
            @endforeach
            @endif


            @elseif($flg == 4)
            <div class="card mx-auto h5 " style="width: 18rem;">
                <div class="card-body text-center ">
                    申し込まれたチーム
                </div>
            </div>
            @if(count($appliedList) == 0 )
            <div class='card'>
                <div>
                    <ul>
                        <li class='list-unstyled h4'>まだ申し込まれていません。</li>
                    </ul>
                </div>
            </div>
            @else
            @foreach($appliedList as $opponents)
            <div class='card'>
                <div>
                    <ul class='col h4'>
                        <div class="row float-right profile-img mr-1">
                            <img src="{{ asset('storage/'.$opponents->game->user->image) }}" class="card-img-top rounded-circle " alt="...">
                        </div>
                        <h3 class='mt-3'>チーム名：</h3>
                        <li class='mr-3 list-unstyled'>{{$opponents->game->user->name}}</li>
                        <h3 class='mt-3'>人数：</h3>
                        <li class='mr-5 ml-3 list-unstyled'>{{\Team::LIST[$opponents->game->user->team]}}</li>
                        <h3 class='mt-3'>エリア：</h3>
                        <li class='mr-3 list-unstyled'>{{\Area::LIST[$opponents->game->user->area]}}</li>
                        <h3 class='mt-3'>メッセージ：</h3>
                        <li class='mr-3 list-unstyled'>{{$opponents->charange_text}}</li>
                        <li class='list-unstyled mt-3'>
                            <form action="{{ route('games.update',$opponents->game->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type='submit' name='accept' class='btn btn-outline-danger'>承認</button>
                                <button type='submit' name='refuse' class='btn btn-outline-secondary'>拒否</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
            @endif

            @endif
        </div>
    </div>
</div>
@endsection