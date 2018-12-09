@extends('shop_panel.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            <b class="fa fa-home"></b> Начало
        </h1>
    </section>
    <div class="row">
        <section class="content">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Приходи</span>
                        <span class="info-box-number">{{ $totalPrice }} ЛВ.<b class="fa fa-money"></b></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-orange-active"><i class="fa fa-server"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Активни сървъри</span>
                        <span class="info-box-number">{{ $totalServers }} <b class="fa fa-link"></b></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>


            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Оборот днес</span>
                        <span class="info-box-number">{{ $todayTurnonver }} ЛВ.<b class="fa fa-money"></b></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>


            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-users"></b> Нови протребители за днес</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <a type="button" href="{{ url('manage/site/'.$site->slug.'/users') }}"
                               class="btn btn-box-tool">
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                            </tr>
                            @foreach($todayUsers as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->username }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-6 justify-content-around">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-info"></b> Информация за плана</h3>

                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body text-center" style="">
                        <img src="{{ asset('images/panel.png') }}" width="150px;" class="justify-content-center">
                        <div class="text-center">
                            Име на плана: <b>{{ $site->plan->name }}</b> <br>
                            PayPal опция: <b>{{ $site->plan->paypal != 0 ? 'Да' : 'Не'  }}</b> <br>
                            Купон опция: <b>{{ $site->plan->giftcards != 0 ? 'Да' : 'Не'  }}</b> <br>
                            Максимум пакети: <b>{{ $site->plan->products }}</b> <br>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-keyboard-o"></b> Име на сайта</h3>

                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">

                        <div class="error-title" style="display: none;">
                            <div class="alert alert-danger" id="errorDesc"></div>
                        </div>

                        <div class="form-group">
                            <input class="form-control" name="title-home" id="title-home" placeholder="Въведете името на сайта"
                                   value="{{ $site->settings()->where('key','title')->first()->value }}">
                        </div>

                    </div>
                    <div id="loader-title" class="overlay" style="display: none;">
                        <li class="fa fa-spin fa-refresh"></li>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-key"></b> Ключови думи</h3>

                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">

                        <div class="error-keywords" style="display: none;">
                            <div class="alert alert-danger" id="errorDesc-keywords"></div>
                        </div>


                        <div class="form-group">
                            <input class="form-control" name="keyword"
                                   id="keywords-home" placeholder="keyword, afterkeyword"
                                   value="{{ $site->settings()->where('key','meta_keywords')->first()->value }}">
                        </div>
                    </div>
                    <div id="loader-keyword" class="overlay" style="display: none;">
                        <li class="fa fa-spin fa-refresh"></li>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-users"></b> Потребители за тази година</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        {!! $yearUserChart->render() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
@endsection