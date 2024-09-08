@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/login-register.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="login-header">ユーザーログイン画面</h2>

                <div class="login-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-form">
                            <input id="password" type="password" class="form-control" name="password" placeholder="パスワード" required autocomplete="password">
                            <div class="input-form-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <div>{{ $message }}</div>
                                </span>
                            @enderror
                            </div>

                            <div class = "input-form-email">
                                <input id="email" type="email" class="form-control" name="email" placeholder="アドレス" value="{{ old('email')}}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="login-btn">
                                <button type="button" onclick ="window.location.href = '/register';" class="btn-primary">新規登録</button>
                                <button type="submit" class="btn-Login">ログイン</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
