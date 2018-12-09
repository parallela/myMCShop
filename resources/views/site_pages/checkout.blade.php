@extends('layouts.index_layout')
@section('content')

    <div class="container">
        <h4 class="text-center"><b class="text-success">@lang('content.price'):</b> {{ $plan->price }} EUR | <b class="text-primary">@lang('content.Plan'):</b> {{ $plan->name }}</h4>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Info:
                    </div>
                    <div class="card-body">
                        <p class="card-text">@lang('content.information')</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Info:
                    </div>
                    <div class="card-body">
                        <p class="card-text">@lang('content.informationsms')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form id="paymentform" style="display: inline;" method="POST" action="{{ route('purchase') }}">
            @method('PUT')
            <div class="text-center col-md-12">
                <div class="card" data-toggle="tooltip" data-html="true" data-placement="top"
                     title='{!! __('content.sitedomainusage') !!}'>
                    <div class="card-header">
                        Site:
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">https://</div>
                                </div>
                                <input type="text" class="form-control" maxlength="32" minlength="4" required id="slug" name="slug" placeholder="shopcraft">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">.mymcshop.com</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="container" style="margin-bottom: 100px;">
                <div class="text-center">
                    @csrf
                    <input type="hidden" value="{{ $plan->id }}" name="p_id">
                    <button id="payment" class="btn btn-primary disabled" type="button"><b
                                class="fab fa-paypal"></b> @lang('content.acceptinf')</button>
                </div>
            </div>
        </form>
    </div>

@endsection