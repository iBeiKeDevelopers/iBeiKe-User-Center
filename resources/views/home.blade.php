@extends('layouts.app')

@section('content')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 justify-content-center d-flex">
            <div id="user-card" class="col-12 m-auto">
                <div class="col-sm-6 offset-sm-3 col-12 px-0">
                    <img src="/assets/top.png">
                </div>
                <div class="col-3 d-sm-block d-none px-0 float-left">
                    <a href="http://city.ibeike.com" target="_blank">
                        <img alt="city.ibeike.com" src="/assets/left.png" />
                    </a>
                </div>
                <div id="user-card-body" class="col-sm-6 col-12 px-0 float-left">
                    {{-- logout --}}
                    <div class="col-8 offset-2">
                        <div class="user-card-logout float-right">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                <span>
                                    <a-icon type="logout"></a-icon>
                                    {{ __('Logout') }}
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
                    <div class="col-6 offset-3">
                        <div class="user-card-header col-12">
                            <h4>{{ __('Basic Information') }}</h4>
                        </div>
                        <table class="user-card-table table table-hover">
                            <tr>
                                <td class="text-right">{{ __('E-Mail Address') }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">{{ __('City username') }}</td>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">{{ __('PT Username') }}</td>
                                <td>{{ $user->pt_name }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-5 offset-3" style="padding-top: 50px;"></div>
                </div>
                <div class="col-3 d-sm-block d-none px-0 float-right">
                    <a href="http://pt.ibeike.com" target="_blank">
                        <img alt="pt.ibeike.com" src="/assets/right.png" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection