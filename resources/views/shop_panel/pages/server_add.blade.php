@extends('shop_panel.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Сървъри
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-plus"></b> Добавяне на сървър <span
                                    class="badge badge-info">Имаш право на още: <div style="display: inline;" id="counter">{{ $site->plan->servers - $servers->count() }}</div></span>
                        </h3>

                    </div>
                    <form method="post" id="addServer">
                        @csrf
                        @method('PUT')

                        <div class="box-body" style="">
                            <div class="form-group">
                                <label for="server">Име на сървъра</label>
                                <input type="text" name="server" id="server" class="form-control"
                                       placeholder="Survival" minlength="2">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-success btn-sm"><b class="fa fa-save"></b> Запамети</button>
                        </div>

                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-4">
                @foreach($servers as $server)
                    <div id="server-{{ $server->id }}" class="box box-info collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $server->name }}</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button type="button" onclick="deleteServer({{ $server->id }})" class="btn btn-box-tool">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                <button type="button" onclick="editServer({{ $server->id }})" class="btn btn-box-tool">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="display: none">
                            <div class="form-group">
                                <textarea disabled class="form-control disabled" name="token">{{ $server->token }}</textarea>
                                <code>Това е токена който Ви трябва за да свържете сървъра със сайта!</code><br>
                                <code>Внимание! Моля, не давайте вашия token на никого!</code>
                            </div>
                            <div class="badge bg-red justify-content-center text-center">
                                MyMCSHOP не отговаря<br> за сървъра Ви ако токена е разпространен!
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                @endforeach
            </div>
        </div>
    </section>

@endsection

