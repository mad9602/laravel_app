@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('編集') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('teams.update',Auth::id()) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('プロフィール画像') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" name="image" class="@error('image') is-invalid @enderror" value="">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('チーム名') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="team" class="col-md-4 col-form-label text-md-right mb-3 ">チーム人数 </label>
                            <select class="custom-select col-md-6 ml-3 @error('team') is-invalid @enderror" name="team">
                                <selected>Open this select menu</option>
                                    <option value="1">1~10人</option>
                                    <option value="2">11~30人</option>
                                    <option value="3">31人以上</option>
                            </select>
                            @error('team')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>

                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="team" class="col-md-4 col-form-label text-md-right mb-3 ">地域 </label>
                            <select class="custom-select col-md-6 ml-3 @error('area') is-invalid @enderror" name="area">
                                <selected>Open this select menu</option>
                                    <option value="1">北海道</option>
                                    <option value="2">東北</option>
                                    <option value="3">関東</option>
                                    <option value="4">近畿</option>
                                    <option value="5">関西</option>
                                    <option value="6">中国</option>
                                    <option value="7">四国</option>
                                    <option value="8">九州</option>
                                    <option value="9">沖縄</option>
                            </select>

                            @error('area')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">紹介文</label>

                            <div class="col-md-6">
                                <input id="body" type="text" class="form-control @error('body') is-invalid @enderror " name="body" value="{{ old('body') }}" required>

                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('編集する') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection