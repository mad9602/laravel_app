@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($flg == "")
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
            </div>


            @elseif($flg == 1)
            <div class='card'>
                <div>
                    <ul class='row'>
                        @if(is_array($matchingList))
                        @foreach($matchingList as $value)
                        <li>{{$value['name']}}</li>
                        @endforeach
                        @else
                        <li>まだマッチングはありません。</li>
                        @endif
                    </ul>
                </div>
            </div>

            @elseif($flg == 2)
            <div class='card'>
                <div>
                    <ul class='row'>
                        @if(is_array($likeList))
                        @foreach($likeList as $value)
                        <li>{{$value['name']}}</li>
                        @endforeach
                        @else
                        <li>いいねしたチームはありません。</li>
                        @endif
                    </ul>
                </div>
            </div>

            @elseif($flg == 3)
            <div class='card'>
                <div>
                    <ul class='row'>
                        @if(is_array($applyList))
                        @foreach($applyList as $value)
                        <li>{{$value['name']}}</li>
                        @endforeach
                        @else
                        <li>まだ申し込んでいません。</li>
                        @endif
                    </ul>
                </div>
            </div>
            @elseif($flg == 4)
            <div class='card'>
                <div>
                    <ul class='row'>
                        @if(is_array($appliedList))
                        @foreach($appliedList as $value)
                        <li>{{$value['name']}}</li>
                        <li>
                            <form action="{{ route('games.update',$value['id']) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type='submit' class='btn btn-outline-danger'>承認</button>
                            </form>
                        </li>
                        @endforeach
                        @else
                        <li>まだ申し込まれていません。</li>
                        @endif
                    </ul>
                </div>
            </div>

            @endif
        </div>
    </div>
</div>
@endsection