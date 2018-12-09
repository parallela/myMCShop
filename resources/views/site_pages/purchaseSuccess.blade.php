@extends('layouts.index_layout')
@section('content')

    <div class="container" id="">
        <div class row>
            <div class="text-center">
                <img src="{{ asset('/images/prices.png') }}">
                <h2>@lang('content.successPayment',['url'=>'/manage/dashboard'])</h2>
            </div>
        </div>
    </div>

@endsection