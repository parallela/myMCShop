@extends('shop.themes.'.$theme.'.layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">@lang('messages.auth.heading')</div>
        <div class="panel-body">
            <form method="post" action="{{ url('/auth/login') }}">
                @csrf
                <div class="username">
                    <div class="input-group">
                        <input placeholder="@lang('messages.login.placeholder')" name="username" class="form-control input-lg" type="text" maxlength="16" minlength="3"
                               onpaste="return false;" required>
                        <div class="input-group-btn">
                            <button id="login"
                                    class="btn btn-success btn-lg" type="submit">@lang('messages.loginbtn')
                                <b class="fa fa-arrow-circle-right"></b>
                            </button></div>
                    </div>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
