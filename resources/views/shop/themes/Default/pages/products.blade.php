@extends('shop.themes.'.$theme.'.layouts.app')
@section('content')
    @foreach($notifications as $notification)
        <div class="panel panel-default">
            <div class="panel-heading"><b class="fa fa-warning animated faa-pulse"></b> {{ $notification->title }}</div>
            <div class="panel-body">
                {!! $notification->content !!}
            </div>
        </div>
    @endforeach
    <div class="panel panel-default">
        <div class="panel panel-body">
            <div class="category">
                <div class="packages-image">
                    @foreach($extras as $product)
                        @include('shop.themes.'.$theme.'.includes.product_modal',['product'=>$product,'userOrders'=>$userOrders])
                        <div class="package">
                            <div class="image">
                                @if($product->max_buys == 1 && $userOrders->contains('product_id',$product->id))
                                    <a>
                                        <img src="{{ asset($product->image) }}" class="toggle-tooltip img-rounded">
                                    </a>
                                @else
                                    <a data-toggle="modal" data-target="#p{{ $product->id }}" class="toggle-modal">
                                        <img src="{{ $product->image }}"
                                             class="toggle-tooltip img-rounded" data-toggle="tooltip" title=""
                                             data-original-title="@lang('messages.tooltip')">
                                    </a>
                                @endif
                            </div>
                            <div class="info">
                                <div class="text">
                                    <div class="name">{{ $product->name }}
                                    </div>
                                    <div class="price">
                                        {{ session()->get('currency') == 'EUR' ? floor($product->price/1.95) : $product->price }}
                                        <small>{{ session()->has('currency') ? session()->get('currency') : 'BGN' }}
                                            {!! $product->discount != null ? '<span class="label label-danger">'.$product->discount.'%</span>' : '' !!} </small>
                                    </div>
                                </div>
                                <div class="button">
                                    @if($product->max_buys == 1 && $userOrders->contains('product_id',$product->id))
                                        <button class="btn btn-sm btn-info btn-block disabled">@lang('messages.purchasedbtn')</button>
                                    @elseif($product->required_product_id != null && !$userOrders->contains('product_id',$product->required_product_id))
                                        <button data-toggle="modal" data-target="#p{{ $product->id }}"
                                                class="btn btn-sm btn-warning btn-block">@lang('messages.infobtn')</button>
                                    @else
                                        <button data-toggle="modal" data-target="#p{{ $product->id }}"
                                                class="btn btn-sm btn-success btn-block">@lang('messages.buybtn')</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection