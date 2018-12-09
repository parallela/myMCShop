@extends('shop.themes.'.$theme.'.layouts.app')

@section('content')
    @include('shop.themes.'.$theme.'.includes.product_modal',compact('product'))
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-left">
                {{ $product->name }}
            </div>
            <div class="text-right">
                {{ session()->get('currency') == 'EUR' ? floor($product->price/1.95) : $product->price }}
                <small>{{ session()->has('currency') ? session()->get('currency') : 'BGN' }}</small>
            </div>
        </div>
        <div class="panel-body">
            @include('shop.themes.'.$theme.'.includes.product_modal',['product'=>$product])
            <div class="checkout">

                <div class="packages">
                    <table class="table table-hover table-striped">
                        <thead>
                        <th>@lang('messages.nofpurchase')</th>
                        <th>@lang('messages.price')</th>
                        <th>&nbsp;</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="name">{{ $product->name }}</td>
                            <td class="price">  {{ session()->get('currency') == 'EUR' ? floor($product->price/1.95) : $product->price }}
                                <small>{{ session()->has('currency') ? session()->get('currency') : 'BGN' }}</small>
                            </td>
                            <td class="buttons">
                                <button data-toggle="modal" data-target="#p{{ $product->id }}"
                                        class="btn btn-info hidden-xs btn-sm toggle-modal"><i
                                            class="fa fa-info-circle"></i></button>
                                <form method="post" action="{{ url('/cart/remove') }}" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                @if($site->plan->giftcards != 0)
                    <div id="couponheader" class="page-header">
                        <h4>@lang('messages.coupon')</h4>
                    </div>

                    <div class="coupons">

                        <div class="redeem">
                            <div id="error" class="alert alert-danger" style="display: none;"></div>
                            <form method="post" id="coupon_add" action="#">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="coupon"
                                           placeholder="Have a coupon code? Enter it here and click redeem."
                                           class="form-control">
                                    <div class="input-group-btn">
                                        <button id="couponSave" class="btn btn-primary">@lang('messages.check') <i
                                                    class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="redeemed">


                        </div>

                    </div>

                @endif

                <form id="method" method="post" action class="gateway">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                    <div id="payment-content">
                        <div class="page-header">
                            <h4>@lang('messages.spm')</h4>
                        </div>

                        <div class="gateways">
                            @if($site->plan->paypal == 1)
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gateway" id="gateway1"
                                               data-id="1">
                                        <img src="{{ asset('/images/paypal.png') }}"/>
                                        PayPal

                                    </label>
                                </div>
                            @endif
                            @if($product->paypal_only != 1)
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gateway" id="gateway2"
                                               data-id="1">
                                        <img src="{{ asset('/images/sms.png') }}"/>
                                        SMS

                                    </label>
                                </div>
                            @endif

                        </div>
                        <div id="smsInputs" style="display: none;">
                            <div class="page-header">
                                <h4>SMS</h4>
                            </div>

                            <div class="text-center visible-xs">
                                <a href="sms:{{ $smsNumber }}?body={{ $smsText }}" class="btn btn-default"> <i
                                            class="fa fa-envelope"></i> @lang('messages.autofillSMS') </a>
                                <p></p>
                            </div>

                            <div class="alert alert-info">
                                @lang('messages.smsinfo',['x'=>$smsX,'text'=>$smsText,'number'=>$smsNumber,'price'=>$product->price])
                                BGN
                            </div>

                            <p style="margin-bottom: 50px;">

                                @if($product->price <= 6 )

                                    <label for="code">Код </label>
                                    <input type="text" name="code" placeholder="{{ __('messages.entercode') }}"
                                           class="form-control" style="width: 200px;"
                                           required minlength="4" maxlength="8">

                                @elseif($product->price == 12 || $product->price == 9.6)

                                    @for($i=0;$i<2;$i++)
                                        <label for="code{{ $i + 1 }}">Код {{ $i + 1 }}</label>
                                        <input placeholder="{{ __('messages.entercode') }}"
                                               type="text" name="code{{ $i + 1 }}" class="form-control input-sm"
                                               style="width: 200px;"
                                               required minlength="4" maxlength="8"><br>
                                    @endfor

                                @elseif($product->price == 18)

                                    @for($i=0;$i<3;$i++)
                                        <label for="code{{ $i + 1 }}">Код {{ $i + 1 }}</label>
                                        <input placeholder="{{ __('messages.entercode') }}"
                                               type="text" name="code{{ $i + 1 }}" class="form-control input-sm"
                                               style="width: 200px;"
                                               required minlength="4" maxlength="8"><br>
                                    @endfor

                                @elseif($product->price == 24)

                                    @for($i=0;$i<4;$i++)
                                        <label for="code{{ $i + 1 }}">Код {{ $i + 1 }}</label>
                                        <input placeholder="{{ __('messages.entercode') }}"
                                               type="text" name="code{{ $i + 1 }}" class="form-control input-sm"
                                               style="width: 200px;"
                                               required minlength="4" maxlength="8"><br>
                                    @endfor

                                @endif
                            </p>
                        </div>
                    </div>


                    <div class="page-header">
                        <h4><input value="true" name="isGift" id="isGift" type="checkbox"> @lang('messages.isGift')</h4>
                    </div>
                    <p>
                    <div class="gift" style="display: none">
                        <div class="label label-danger">Потребителя трябва да е влизал поне един път в сайта!</div>
                        <hr/>
                        <div class="form-group">
                            <input type="text" placeholder="Въведи името на играча" maxlength="16" minlength="3"
                                   class="form-control" id="username" name="username">
                        </div>
                    </div>

                    <div class="privacyStatement">
                        <div class="page-header">
                            <h4>@lang('messages.tos')</h4>
                        </div>
                        <p>
                            <input type="checkbox" name="privacyConsent" id="privacyConsent" value="1"
                                   required="required"/>
                            <label for="privacyConsent" class="form__choice"
                                   style="display:inline;font-weight:normal;font-size:14px;">
                                @lang('messages.tosDesc')
                            </label>
                        </p>
                        <br>

                    </div>

                    <div class="page-header">
                        <h4>@lang('messages.buybtn')</h4>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="true" name="agreement">
                                    @lang('messages.accepttos')
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <button onclick="document.getElementById('method').submit()" type="submit" class="btn btn-success btn-block"
                                        data-loading-text="Loading, please wait...">@lang('messages.buybtn') &raquo;
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection