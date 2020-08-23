@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 justify-content-center d-flex">
            <div class="card d-inline-block m-auto">
                <div class="card-header">
                    <span class="card-title">iBeiKe 用户{{ __('Register') }}&nbsp;</span>

                    <a class="card-link" href="{{ route('login') }}">{{ __('Login') }}</a>

                    <span class="float-right">
                        <a href="#" data-toggle="tooltip" title="目前仅开放学生邮箱的注册！（学号@xs.ustb.edu.cn）">
                            <a-icon type="info-circle" />
                        </a>
                    </span>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <a-icon type="user" />
                                    </span>
                                </div>
                                <input id="username" type="text" placeholder="{{ __('Username') }}"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <email-validator oldemail="{{ old('email') }}" @error('email') message="{{ $message }}"
                                @enderror placeholder="{{ __("Student E-Mail, Do not forget the 'xs' prefix") }}">
                            </email-validator>
                        </div>


                        <div class="form-group row">
                            <div class="col-12 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <a-icon type="lock" />
                                    </span>
                                </div>
                                <input id="password" type="password" placeholder="{{ __('Password') }}"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <a-icon type="lock" />
                                    </span>
                                </div>
                                <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}"
                                    class="form-control" name="password_confirmation" required
                                    autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection