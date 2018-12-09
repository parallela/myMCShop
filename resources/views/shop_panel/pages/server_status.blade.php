@extends('shop_panel.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Сървър статус
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-toggle-on"></b> Сървър статус</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <div class="callout callout-info">
                            <h4>Информация!</h4>

                            <p>Сървър статуса се проверя от нашия API сървър разположен на машина в <strong>Europe/Germany(DE)</strong><br>
                                <code>Внимание:</code> ако API сървъра не работи това значи, че вашия статус няма да
                                работи също! <br>
                            <hr/>
                            <div class="text-center">
                                <strong>API статус: <div style="display: inline;" class="text-success">ONLINE</div></strong><br />
                                <strong>Линк: <div class="text-blue" style="display: inline;">de.api.{{ env('PLAIN_URL') }}</div></strong><br />
                                <strong>Пинг: <div class="text-blue" style="display: inline;" id="ping"></div> ms</strong>
                            </div>
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="server_s">Сървър ИП:</label>
                            <input type="text" class="form-control" name="server_s" id="server_s" value="{{ $current_ip }}">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection

