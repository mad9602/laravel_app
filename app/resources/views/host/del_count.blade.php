@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="/teams?id={{$user['id']}}">
        @csrf
        <div class="form-group row">
            <label for="body" class="col-md-4 col-form-label text-md-right">報告する</label>
            <div class="col-md-6">
                <input id="body" type="text" class="form-control @error('body') is-invalid @enderror " name="report" value="{{ old('body') }}" required>
                @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <button type='submit'>報告する</button>
        </div>
    </form>

</div>





@endsection