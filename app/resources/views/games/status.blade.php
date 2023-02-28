@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="/games?id={{$request -> id}}">
        @csrf
        <div class="form-group row">
            <label for="body" class="col-md-4 col-form-label text-md-right font-weight-bold">申込み文</label>
            <div class="col-md-6">
                <input id="body" type="text" class="form-control @error('body') is-invalid @enderror " name="body" value="{{ old('body') }}" required>
                @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type='submit' class="btn btn-outline-light">申し込む</button>
        </div>
    </form>
</div>

@endsection