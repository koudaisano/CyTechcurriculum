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
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('名前') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                            </div>
                                        @error('name')
                                    <div class="alert-alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                                            </div>
                                                @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <div class="alert-alert-danger">{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email">
                                        </div>
                                    @error('email')
                                 <div class="alert-alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('パスワード確認用') }}</label>
                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                            </div>
                                        @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                    <div class="alert-alert-danger">{{ $message }}</div>
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
