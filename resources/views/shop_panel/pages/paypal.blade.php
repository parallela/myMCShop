@extends('shop_panel.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            PayPal
        </h1>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-link"></b> Свързване с PayPal</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <form method="post" id="paypal-update">
                        @csrf
                        <div class="box-body" style="">
                            <div class="form-group-sm">
                                <input class="form-control" type="text" name="clientID" id="clientID"
                                       placeholder="XXXXXXXXXXXXXXXXX" value="{{ $site->settings()->where('key','paypal_client_id')->first()->value }}">
                            </div>
                            <br/>
                            <div class="form-group-sm">
                                <input class="form-control" type="text" name="secretID" id="secretID"
                                       placeholder="XXXXXXXXXXXXXXXXX" value="{{ $site->settings()->where('key','paypal_secret')->first()->value }}">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button class="btn btn-success btn-sm"><b class="fa fa-save"></b> Запамети</button>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
                <!-- /.box -->
            </div>

        </div>
    </section>
@endsection

