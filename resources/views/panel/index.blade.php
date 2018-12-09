@extends('panel.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Начална страница
        </h1>
    </section>

    <!-- Main content -->
    <section class="content row">
        <!-- Default box -->
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><b class="fa fa-desktop"></b> Планове</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" class="text-center">
                    <img src="{{ asset('/images/panel.png') }}" class="center-block" width="175px;"/>

                    <center>
                        <strong>Вземи план за да имаш право до администраторския панел и всичките функций на
                            сайта!</strong>
                    </center>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.box -->

        <!-- Default box -->
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><b class="fa fa-info-circle"></b> Информация</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" class="text-center">
                    <img src="{{ asset('/images/plan-info.png') }}" class="center-block" height="160px;"/>

                    <center>
                        <strong>Може да видиш сайтовете и плановете по-долу в сайта на началната страница!</strong>
                    </center>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.box -->
        <!-- Default box -->
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><b class="fa fa-shield"></b> DoS защита</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" class="text-center">
                    <img src="{{ asset('/images/ddos-protection.jpg') }}" class="center-block" height="160px;"/>

                    <center>
                        <strong>Вашия сайт е защитен от <a
                                    href="https://en.wikipedia.org/wiki/Denial-of-service_attack">DoS</a> атаки
                            !</strong>
                    </center>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.box -->

        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><b class="fa fa-globe"></b> Вашите сайтове</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    @foreach($userSites as $site)
                        <div class="col-md-12">
                            <div class="box box-default box-solid collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">
                                        <b class="fa fa-link"></b>
                                        <a href="https://{{ $site->slug }}.{{ env('PLAIN_URL') }}">{{ $site->settings()->where('key','title')->first()->value }}</a>
                                        /
                                        <b class="fa fa-calendar"></b> Изтича на: {{ $site->pivot->expires_at }}
                                    </h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" style="display: none;">
                                    <a href="{{ route('site.home',$site->slug) }}" class="btn btn-success text-center">Към панела</a>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    @endforeach
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><b class="fa fa-warning"></b> ВНИМАНИЕ</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <img src="{{ asset('/images/creeper.jpg') }}" class="center-block" height="160px;"/>

                    <li>
                        <strong>За да си направите СМС услуги или взимате парите от тях трябва да имате навършени <font color="red">18</font> години!</strong>
                    </li>
                    <li>
                        <strong>При активиране на плащане с PAYPAL, трябва да посочите <font color="red">ClientID и SecretID</font>!</strong>
                    </li>
                    <li>
                        <strong>Ако администраторите на <font color="#7fffd4">MyMCShop</font> забележат, че някой от магазините се ползва с цел измама, магазина ще бъде премахнат
                            завинаги а потребителя ще бъде баннат!</strong>
                    </li>
                    <li>
                        <strong>Тъй като Shop системата е в <font color="red">BETA</font> версия е възможно да има бъгове! Ако се възползвате от бъг вие ще бъдете
                            баннат <font color="red">ЗАВИНАГИ</font> без значение дали имате или нямате магазин!</strong>
                    </li>
                    <hr />
                    <img src="{{ asset('/images/logo.png') }}" class="center-block" height="80px;"/>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection