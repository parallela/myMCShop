@extends('shop.themes.'.$theme.'.layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">@lang('messages.swr')</div>
        <div class="panel-body text-center">
            <img src="{{ asset('/images/security.png') }}" height="150px;" width="150px;"/>


            @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <h3>{{ $error }}</h3><br>
                        @endforeach
            @endif
        </div>
    </div>
@endsection