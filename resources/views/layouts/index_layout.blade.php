<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Minecraft SMS,BuyCraft,Minecraft cms system,cs-bg.info Minecraft,Vm,Майкрафт магазин,shop,пари minecraft,iplexmc,divictusgaming,adminltepanel,vbuy,mbuy">
    <meta name="author" content="Lubomir Stankov">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>myMCShop | Home</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/starrating.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

</head>

<body>

<div class="menu d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal"><img width="120px;" height="80px;"
                                                        src="{{ asset('/images/logo.png') }}"></h5>
    @if(!request()->is('login') && !request()->is('register'))
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="btn btn-outline-success p-2 text-dark" href="{{ route('home') }}"><b
                        class="fa fa-home"></b> @lang('content.home')</a>
            <a class="btn btn-outline-success p-2 text-dark"
               href="{{ request()->is('cart/*') ? route('home')."#prices" : '#prices' }}"><b
                        class="fa fa-coins"></b> @lang('content.prices')
            </a>
            <a class="btn btn-outline-success p-2 text-dark"
               href="{{ request()->is('cart/*') ? route('home')."#clients" : '#clients' }}"><b
                        class="fa fa-users"></b> @lang('content.clients')
            </a>
            @if(Auth::user())
                <form style="display: inline;" method="post" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger p-2 text-dark" type="submit"><b
                                class="fa fa-sign-out-alt"></b> @lang('content.logout'), {{ Auth::user()->name }}</button>
                </form>
            @endif
            @if(Auth::user() && count(Auth::user()->sites ) > 0)
                <a class="btn btn-success" href="{{ route('manage.dashboard') }}"><b class="fa fa-monitor"></b> @lang('content.sites') | <span
                            class="badge badge-danger">{{ Auth::user()->sites->count() }}</span></a>
            @else
                <a class="btn btn-info" href="{{ Auth::user() ?  route('home')."#prices" : route('login') }}"><b
                            class="fa fa-plus"></b> @lang('content.create_your_site_now')</a>
            @endif
        </nav>
    @endif
</div>
@if(!session()->has('gdpr'))
    @include('modals.gdpr')
@endif

@yield('content')

<div id="cookieConsent">
    <div id="closeCookieConsent">x</div>
    This website is using cookies. <a href="https://cookiesandyou.com/" target="_blank">More info</a>. <a
            class="cookieConsentOK">That's Fine</a>
</div>


<!-- Footer -->
<footer class="footer">
    <div class="container">
        <span class="text-muted">&copy; Lubomir Stankov | UI by: Lubomir Stankov</span>
    </div>
</footer>
<!-- Footer -->


<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="{{ asset('/js/popper.min.js') }}"></script>
<script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script src="{{ asset('/js/particle-conf.js') }}"></script>
<script>
    /*
    | Type plugin for main page
     */
    var typed = new Typed('#heading-Type', {
        strings: ['{{ __('content.low_prices') }}', '{{ __('content.admin_panel') }}', '{{ __('content.security') }}'],
        typeSpeed: 30,
        smartBackspace: true,
        showCursor: false,
        backDelay: 3000,
        loop: true,
        loopCount: Infinity,
    });
</script>
<script src="{{ asset('/js/site.js') }}"></script>
</body>
</html>