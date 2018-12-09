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

<div id="header">

    <div class="header">
        <div class="container">
            <div class="logo">
                <p><i class="fa fa-shopping-cart"></i>&nbsp;{{ $title }}</p>
            </div>
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

    <div id="logo">
        <div class="container">
            <a href="{{ url('/') }}">
                <img src="{{ $logo }}" alt="{{ $title }}">
            </a>
        </div>
    </div>

    <div class="container">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="{{ request()->is('/') ? 'active' : ''}}"><a href="{{ url('/') }}"><b
                                        class="fa fa-home"></b> @lang('messages.home')</a></li>
                        @foreach ($categories as $cat)
                            <li class="{{ $cat->children->count() > 0 ? 'dropdown' : ''}} {{ request()->is('category/'.$cat->slug) ? 'active' : '' }}">
                                <a href="{{ url('/category/'.$cat->slug) }}"
                                   class="{{ $cat->children->count() > 0 ? 'dropdown-toggle' : ''  }}"
                                   data-toggle="{{ $cat->children->count() > 0 ? 'dropdown' : ''  }}">
                                    <b
                                            class="glyphicon {{ $cat->icon }}"></b> {{$cat->name}} {!! $cat->children->count() > 0 ? '<b class="fa fa-caret-down"></b>' : '' !!}
                                    {!! count($cat->products()->where('discount','!=',null)->get()) == 0 ? '' :
                                     '<span class="label label-danger">'.count($cat->products()->where('discount','!=',null)->get()).'</span>'
                                     !!}
                                </a>
                                <ul class="dropdown-menu">
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
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="container">
    <div class="notification">

    </div>

    <div class="body">
        <div class="{{ request()->is('cart') ? 'full-width' : 'content' }}">
            @yield('content')
        </div>
        @if(!request()->is('cart'))
            <div class="sidebar">
                @include('shop.themes.'.$theme.'.includes.sidebars',compact('sidebars'))
            </div>
        @endif
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
</div>

<script
        src="https://code.jquery.com/jquery-1.11.0.min.js"
        integrity="sha256-spTpc4lvj4dOkKjrGokIrHkJgNA0xMS98Pw9N7ir9oI="
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('/styles/'.$theme.'/bootstrap.min.js') }}"></script>
<script src="{{ asset('/core/site.js') }}"></script>

</body>
</html>