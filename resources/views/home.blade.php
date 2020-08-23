@extends('layouts.app')

@section('content')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 justify-content-center d-flex">
            <div id="user-card" class="col-12 m-auto">
                <div class="col-lg-6 offset-lg-3 col-12 px-0">
                    <img src="/assets/top.png">
                </div>
                <div class="col-2 offset-1 d-lg-block d-none px-0 float-left">
                    <a href="http://city.ibeike.com" target="_blank">
                        <img alt="city.ibeike.com" src="/assets/left.png" />
                    </a>
                </div>
                <div id="user-card-body" class="col-lg-6 col-12 px-0 float-left">
                    {{-- logout --}}
                    <div class="col-8 offset-2">
                        <div class="user-card-logout float-right">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                <span>
                                    <a-icon type="logout" style="vertical-align: 0;"></a-icon>
                                    <span style="vertical-align: text-top;">{{ __('Logout') }}</span>
                                </span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    {{-- avatar --}}
                    <div class="user-card-avatar mx-auto">
                        <img class="rounded-circle" src="{{ $user->avatarURL }}">
                    </div>
                    {{-- basic info --}}
                    <div class="col-8 mx-auto">
                        <div class="user-card-header col-8 offset-1">
                            <h4>{{ __('Basic Information') }}</h4>
                        </div>
                        <table class="user-card-table table table-hover">
                            <tr>
                                <td class="text-center">
                                    Mail
                                    <br />
                                    <a-icon type="mail" />
                                </td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    City
                                    <br />
                                    <a-icon type="user"></a-icon>
                                </td>

                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    PT
                                    <br />
                                    <a-icon type="user"></a-icon>
                                </td>
                                <td>{{ $user->pt_name }}</td>
                            </tr>
                        </table>

                        {{-- Secure Infomation --}}
                        <div class="user-card-header col-8 offset-1">
                            <h4>{{ __('Secure Information') }}</h4>
                        </div>

                        <div class="col-8 offset-2 col-lg-10 offset-lg-3">
                            <div class="col-12">
                                <a href="{{ route('password.update') }}" class="button button-link">
                                    {{ __('Reset Password') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-5 offset-3" style="padding-top: 50px;"></div>
                </div>
                <div class="col-2 d-lg-block d-none px-0 float-left">
                    <a href="http://pt.ibeike.com" target="_blank">
                        <img alt="pt.ibeike.com" src="/assets/right.png" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection