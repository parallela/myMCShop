<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-slug" content="{{ $site->slug }}">
    <title>myMCShop | {{ request()->url()}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.3.0/collection/icon/icon.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/panel/css/AdminLTE.css') }}" />
    <!-- jQuery 3 -->
    <script src="{{ asset('/panel/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- GlyphIcon for icon picker -->
    <link rel="stylesheet" href="https://victor-valencia.github.io/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.css" />
    <!-- Jquery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/css/skins/_all-skins.css">
    <!-- CK EDIT -->
    <script src="https://cdn.ckeditor.com/4.10.0/full-all/ckeditor.js"></script>

    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .content {
            min-height: 650px;
        }
    </style>
</head>
<body class="hold-transition skin-black sidebar-mini layout-boxed"
      style="background-image: url(https://creative-fun.net/data/images/cfbackground-medium.png);">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/manage/dashboard') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>MC</b>S</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">MYMCSHOP</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" style="">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-download"></i> Свали плъгина
                        </a>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <p>
                                    {{ Auth::user()->name }}
                                    <small style="">В момента имаш {{ Auth::user()->sites()->count() }} активен сайт!
                                    </small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-6 text-center">
                                        <a href="{{ route('home')."#plans" }}">Планове</a>
                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <a href="{{ route('manage.upgrade') }}">Ъпгрейд</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('home') }}" class="btn btn-default btn-flat"><b
                                                class="fa fa-home"></b> Начало</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('manage.profile') }}" class="btn btn-default btn-flat"><b
                                                class="fa fa-user"></b> Профил</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar" style="min-height: 0%">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">


                <li class="header"><b class="fa fa-navicon"></b> Навигация</li>
                <li class="{{ request()->is('manage/site/*/home') ? 'active' : '' }}">
                    <a href="{{ route('site.home',[request()->route()->parameter('slug')]) }}">
                        <i class="fa fa-dashboard"></i> <span>Начало</span>
                    </a>
                </li>

                <li class="{{ request()->is('manage/site/*/design/*') ? 'active' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-paint-brush"></i> <span>Дизайн</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu" style="">
                        <li><a href="{{ route('site.sidebars',[$site->slug]) }}"><i class="fa fa-navicon"></i>
                                Менюта</a></li>
                        <li><a href="{{ route('site.notifications',[$site->slug]) }}"><i class="fa fa-info-circle"></i>
                                Нотификации</a></li>
                        <li><a href="{{ route('site.design',[$site->slug]) }}"><i class="fa fa-picture-o"></i> Смени
                                дизайна</a></li>
                        <li><a href="{{ route('site.homepage',[$site->slug]) }}"><i class="fa fa-home"></i> Начална
                                страница</a></li>
                    </ul>
                </li>


                <li class="{{ request()->is('manage/site/*/server/*') ? 'active' : '' }} treeview">
                    <a href="{{ route('site.home',[$site->slug]) }}">
                        <i class="fa fa-server"></i> <span>Сървър</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu" style="">
                        <li><a href="{{ route('site.serveradd',[$site->slug]) }}"><i class="fa fa-plus-circle"></i>
                                Добави сървър</a></li>
                        <li><a href="{{ route('site.serverconnection',[$site->slug]) }}"><i
                                        class="fa fa-connectdevelop"></i> Връзка със сървъра</a></li>
                        <li><a href="{{ route('site.serverstatus',[$site->slug]) }}"><i class="fa fa-signal"></i> Сървър
                                статус</a></li>
                    </ul>
                </li>

                <li class="header"><b class="fa fa-dollar"></b> Плащане</li>

                <li class="{{ request()->is('manage/site/*/sms') ? 'active' : '' }}">
                    <a href="{{ route('site.sms',[$site->slug]) }}">
                        <i class="fa fa-envelope"></i> <span>SMS</span>
                    </a>
                </li>

                @if($site->plan->giftcards != 0)
                    <li class="{{ request()->is('manage/site/*/coupons') ? 'active' : '' }}">
                        <a href="{{ route('site.coupons',[$site->slug]) }}">
                            <i class="fa fa-gift"></i> <span>Купони (Виртуална сметка)</span>
                        </a>
                    </li>
                @endif


                @if($site->plan->paypal != 0)
                    <li class="{{ request()->is('manage/site/*/paypal') ? 'active' : '' }}">
                        <a href="{{ route('site.paypal',[$site->slug]) }}">
                            <i class="fa fa-paypal"></i> <span>PayPal</span>
                        </a>
                    </li>
                @endif

                <li class="header"><b class="fa fa-star-half-o"></b> Продукти и Категории</li>

                <li class="{{ request()->is('manage/site/*/products') ? 'active' : '' }}">
                    <a href="{{ route('site.home',[request()->route()->parameter('slug')]) }}">
                        <i class="fa fa-shopping-cart"></i> <span>Продукти</span>
                    </a>
                </li>


                <li class="{{ request()->is('manage/site/*/products/addcmd') ? 'active' : '' }}">
                    <a href="{{ route('site.home',[request()->route()->parameter('slug')]) }}">
                        <i class="fa fa-pencil"></i> <span>Добави команда към продукт</span>
                    </a>
                </li>

                <li class="{{ request()->is('manage/site/*/categories') ? 'active' : '' }}">
                    <a href="{{ route('site.categories',[$site->slug]) }}">
                        <i class="fa fa-desktop"></i> <span>Категории</span>
                    </a>
                </li>

                <li class="header"><b class="fa fa-user"></b> Потребители</li>


                <li class="{{ request()->is('manage/site/*/users') ? 'active' : '' }}">
                    <a href="{{ route('site.home',[request()->route()->parameter('slug')]) }}">
                        <i class="fa fa-users"></i> <span>Потребители</span>
                    </a>
                </li>

                <li class="{{ request()->is('manage/site/*/administrators/*') ? 'active' : '' }} treeview">
                    <a href="{{ route('site.home',[request()->route()->parameter('slug')]) }}">
                        <i class="fa fa-terminal"></i> <span>Администрация</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu" style="">
                        <li><a href="index.html"><i class="fa fa-plus-circle"></i> Добави администратор</a></li>
                    </ul>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> <b>Beta | 1.0.0</b>
        </div>
        <strong>Copyright &copy; 2018-{{ date('Y') }} </strong> All rights
        reserved. <a href="https://lstankov.me">Lubomir Stankov</a>
    </footer>


</div>
<!-- ./wrapper -->


<!-- JQUERY UI -->
<script
        src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
        integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
        crossorigin="anonymous"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('/panel/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<!-- inlineEdit -->
<!-- AdminLTE App -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('/panel/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/panel/js/pinger.js') }}"></script>
<script src="{{ asset('/panel/js/editable.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://victor-valencia.github.io/bootstrap-iconpicker/dist/js/bootstrap-iconpicker-iconset-all.js"></script>
<script src="https://victor-valencia.github.io/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.js"></script>
<script src="{{ asset('/panel/js/ajax.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>

</body>
</html>
