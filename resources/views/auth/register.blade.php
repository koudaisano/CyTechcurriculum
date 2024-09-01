@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/login-register.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="register-header">ユーザー新規登録画面</h2>

                <div class="register-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                    <div class = "input-form">
                            <div class="input-form-password">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="パスワード" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-form-email">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="アドレス" value="{{ old('email')}}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>

                        <div class="register-btn">
                                <button type="submit" class="btn-primary">新規登録</button>
                                <button type="button" onclick ="window.location.href = '/login';" class="btn-back">戻る</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
