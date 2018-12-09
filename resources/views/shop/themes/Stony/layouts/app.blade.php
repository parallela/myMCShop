<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta name="description" content="{{ $meta_desc }}">
    <title>{{ $title }}</title>

    <link href="{{ asset('/styles/'.$theme.'/style.css') }}" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <!-- ICONS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @include('shop.themes.'.$theme.'.includes.style',compact('background_image'))
</head>
<body>

<header>
    <div class="logo">
        <div class="wrapper"></div>
        <a href="{{ url('/') }}"><img src="{{ $logo }}" alt="logo"/></a></div>
    </div>
    <div class="player-bar">
        <div class="wrapper">
            <div class="buttons">
                <div class="toolbar">
                    @if(Auth::guard('mcuser')->user())
                        <div class="logout">
                            <a href="{{ url('/auth/logout') }}" id="logout" class="btn btn-danger"><b
                                        class="fa fa-sign-out"></b> @lang('messages.logout')</a>
                        </div>
                        <div class="currency">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                <b class="fa fa-dollar"></b> {{ session()->has('currency') ? session()->get('currency') : 'BGN'}}
                                <span class="fa fa-caret-down"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li class="{{ (session()->has('currency') && session()->get('currency') == 'BGN') ? 'active' : '' }}">
                                    <a href="{{ url('/currency/BGN') }}">BGN</a>
                                </li>
                                <li class="{{ (session()->get('currency') == 'EUR') ? 'active' : '' }}">
                                    <a href="{{ url('/currency/EUR') }}">EUR</a>
                                </li>
                            </ul>
                        </div>
                        @if(!request()->is('cart'))
                            <div class="basket">
                                <button data-toggle="dropdown"
                                        class="btn btn-info btn-sm dropdown-toggle  {{ $cartCount > 0 ? '' : 'disabled' }}">
                                    <i class="icon-shopping-cart icon-white"></i>
                                    {{ $cartCount }} @lang('messages.itemsinbasket')
                                    {!! $cartCount > 0 ? '<b class="fa fa-caret-down"></b>' : '' !!}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li class="item">
                                        <div class="name">{{ !empty($cartItem->product->name) ? $cartItem->product->name : '' }}</div>
                                        <div class="price">
                                            @if(!empty($cartItem->product->price))
                                                {{ session()->get('currency') == 'EUR' ? floor($cartItem->product-e >price/1.95) : $cartItem->product->price}}
                                            @endif
                                            <small>{{ session()->has('currency') ? session()->get('currency') : 'BGN' }}</small>
                                        </div>
                                        <div class="remove">
                                            <form style="display: inline;"
                                                  method="post"
                                                  action="{{ url('/cart/remove') }}">
                                                <input type="hidden"
                                                       value="{{ !empty($cartItem->product->id) ? $cartItem->product->id: '' }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-success btn-xs" type="submit">
                                                    <span class="fa fa-times" span=""></span>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                    <li class="checkout">
                                        <div class="total"><b>@lang('messages.total')
                                                :</b> {{ !empty($cartItem->product->price) ? $cartItem->product->price : ''}}
                                            <small>BGN (Лв.)</small>
                                        </div>
                                        <div class="button">
                                            <form style="display: inline;" action="{{ url('/cart') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id"
                                                       value="{{ !empty($cartItem->product->id) ? $cartItem->product->id : '' }}">
                                                <button type="submit" href="/cart"
                                                        class="btn btn-success">@lang('messages.buybtn')</button>
                                            </form>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

<section id="main" class="wrapper">

    <aside>
        <nav id="categories">
            <ul>
                <li class="">
                    <a href="{{ url('/') }}" class="category category-home {{ request()->is('/') ? 'active' : ''}}">
                        <span class="category-icon"></span>
                        <span class="category-title">@lang('messages.home')</span>
                    </a>
                </li>
                @foreach($categories as $cat )
                    <li class="">
                        <a href="{{ url('/category/'.$cat->slug) }}"
                           class="category category-{{ $cat->slug }} {{ $cat->children->count() > 0 ? 'dropdown-toggle' : ''  }} {{ request()->is('category/'.$cat->slug) ? 'active' : ''}}"
                           data-toggle="{{ $cat->children->count() > 0 ? 'dropdown' : ''  }}">
                            <span class="category-icon"></span>
                            <span class="category-title"> {{$cat->name}} <span class="{!! $cat->children->count() > 0 ? 'fa fa-caret-down' : '' !!}"
                                                                    style="margin-left: 12px; margin-top: 2px;"></span></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            @foreach($subcategories as $sub)
                                @if($sub->parent_id == $cat->id)
                                    <li>
                                        <a href="{{ url('category/'.$sub->slug) }}">
                                            {{ $sub->name }}
                                            {!! count($sub->products()->where('discount','!=',null)->get()) == 0 ? '' :
                                            '<span class="label label-danger" >'.count($sub->products()->where('discount','!=',null)->get()).'</span>'
                                            !!}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="sidebar">

        </div>
    </aside>

    <section class="page">

        <div class="container">

            <div class="notification">

            </div>

            <div class="body">
                <div class="content">
                    @yield('content')
                </div>
                <div class="sidebar">

                </div>
            </div>


            <div class="footer">
                <div class="language">
                    <div class="dropdown dropup">
                        <a href="#" class="dropdown-toggle text-light" data-toggle="dropdown"><span class="fa fa-globe"></span>
                            @lang('messages.lang')</a>
                        <ul class="dropdown-menu up">
                            <li>
                                <a href="{{ app()->isLocale('en') ? url('language/bg') : url('language/en')   }}">
                                    {{ app()->isLocale('en') ? 'Български' : 'Английски'  }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="branding">
                    &copy; {!! $site->plan->show_brand == 0 ? $title : '<a href="https://mymcshop.com">MyMCShop</a>'  !!}
                </div>
            </div>
        </div>
    </section>
</section>

<script
        src="https://code.jquery.com/jquery-1.11.0.min.js"
        integrity="sha256-spTpc4lvj4dOkKjrGokIrHkJgNA0xMS98Pw9N7ir9oI="
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('/styles/'.$theme.'/bootstrap.min.js') }}"></script>
<script src="{{ asset('/core/site.js') }}"></script>
</body>

</html>