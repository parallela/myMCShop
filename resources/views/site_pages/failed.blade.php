@extends('layouts.index_layout')
@section('content')
    <div class="container">
        <div class="text-center">
                <img src="{{ asset('/images/failed.png') }}">
                @if ($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
        </div>
    </div>
@endsection