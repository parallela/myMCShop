@extends('layouts.index_layout')
@section('content')
    <div class="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div id="particles-js" style="background-image: url('{{ asset('/images/carouselBG.png') }}')"></div>
                    <div class="carousel-caption text-left">
                        <h1 class="text-center" id="heading-Type"></h1>
                        <p class="text-center">@lang('content.welcome')</p>
                        <div class="text-center">
                            <p>
                                <a class="btn btn-lg btn-primary"
                                   href="{{ Auth::user() ?  route('home')."#prices" : route('login') }}"
                                   role="button"><b
                                            class="fa fa-plus"></b> @lang('content.create_your_site_now')</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4">
                <img
                        src="{{ asset('/images/panel.png') }}"
                        alt="Generic placeholder image" width="140" height="140">
                <h2>@lang('content.admin_panel')</h2>
                <p>@lang('content.admin_panel_desc')</p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img
                        src="{{ asset('/images/security.png') }}"
                        alt="Generic placeholder image" width="140" height="140">
                <h2>@lang('content.security')</h2>
                <p>@lang('content.security_desc')</p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img
                        src="{{ asset('/images/prices.png') }}"
                        alt="Generic placeholder image" width="140" height="140">
                <h2>@lang('content.payments')</h2>
                <p>@lang('content.payments_desc')</p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


    </div><!-- /.container -->
    <section id="prices" class="pricing py-5"
             style="background-image: url('{{ asset('/images/carouselBG2.png') }}'); width: auto;">
        <div class="container">
            <div class="row">
                <!-- Free Tier -->
                @foreach($plans as $plan)
                    <div class="col-lg-4">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">{{ $plan->name }}</h5>
                                <h6 class="card-price text-center">{{ $plan->price }}EUR<span
                                            class="period">/@lang('content.mounth')</span></h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i
                                                    class="fas fa-server"></i></span>{{ $plan->servers }} @lang('content.serverc')
                                    </li>
                                    <li><span class="fa-li"><i
                                                    class="fas fa-shopping-cart"></i></span>{{ $plan->products }} @lang('content.products')
                                    </li>
                                    <li><span class="fa-li"><i
                                                    class="fas fa-location-arrow"></i></span>{{ $plan->categories }} @lang('content.categories')
                                    </li>
                                    <li><span class="fa-li"><i class="fas fa-terminal"></i></span>
                                        @lang('content.commands')</li>
                                    <li><span class="fa-li"><i
                                                    class="fas fa-{{ $plan->giftcards == 0 ? 'times' : 'gift' }}"></i></span>
                                        @lang('content.giftcard')</li>
                                    <li><span class="fa-li"><i
                                                    class="{{ $plan->paypal == 0 ? 'fas' : 'fab' }} fa-{{ $plan->paypal == 0 ? 'times' : 'paypal'}}"></i></span>
                                        @lang('content.paypal')</li>
                                    <li><span class="fa-li"><i
                                                    class="fas fa-envelope-square"></i></span> @lang('content.sms')</li>
                                    <li><span class="fa-li"><i
                                                    class="fas fa-{{ $plan->upgrades == 0 ? 'times' : 'chart-line'}}"></i></span>
                                        @lang('content.upgrades')</li>
                                    <li><span class="fa-li"><i
                                                    class="fa fa-{{ $plan->show_brand == 1 ? 'times' : 'copyright'}}"></i></span>
                                        @lang('content.show_brand')</li>
                                    <li><span class="fa-li"><i class="fas fa-paint-brush"></i></span> @lang('content.designs')</li>
                                </ul>
                                @if(!Auth::check())
                                    <a href="{{ route('login') }}"
                                       class="btn btn-block btn-danger text-uppercase">@lang('signup')</a>
                                @else
                                    <form method="post" action="{{ route('checkout') }}">
                                        @csrf
                                        <input type="hidden" name="p_id" value="{{ $plan->id }}">
                                        <button type="submit"
                                                class="btn btn-block btn-success text-uppercase">@lang('content.buy')</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Clients -->
    <section class="container" id="clients">
        <div class="row">
            <h2 class="">@lang('content.our_clients'): <span class="badge badge-danger"> {{ $sites->count() }} </span>
            </h2>
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>Site</th>
                    <th>Plan</th>
                </tr>
                @foreach ($sites as $site)
                    <tr>
                        <td>
                            <a href="https://{{ $site->slug }}.{{ env('PLAIN_URL') }}">
                                <img src="{{ $site->settings()->where('key','logo')->first()->value }}" width="150px;"
                                     height="50px;">
                            </a>
                        </td>
                        <td>{{ $site->plan->name }} <b class="fa fa-star"></b></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </table>
        </div>
    </section>
@endsection