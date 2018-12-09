@extends('shop_panel.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Връзка със сървъра
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-link"></b> Свързване със сървъра</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <form method="POST" action="">
                        @csrf
                        <div class="box-body" style="">
                            <div class="callout callout-info">
                                <h4>Информация!</h4>

                                <p>
                                    <strong>За да направите връзка м/у сайта и вашият сървър, трябва да изберете за кой
                                        сървър искате връзка в полето по-долу и да натиснете бутова
                                        <button type="button" class="btn btn-success btn-xs">Свали конфигурацията <b
                                                    class="fa fa-download"></b></button>
                                        след което , на вашият компютър ще
                                        бъде свален <code>.zip</code> файл, който трябва да разархивирате в
                                        <code>/plugins</code> директорията на вашия сървър!
                                        След като направите това вашият сървър ще проверява за нови покупки на всеки <b
                                                class="text-red">2</b> минути!
                                        <br>
                                        <b class="fa fa-warning"></b> <b class="text-red">Ако искате да промените
                                            интервала,
                                            трябва да отворите <code>/plugins/MyMCShop/config.yml</code> файла и да
                                            редактирате
                                            <code>interval</code> секцията!</b>
                                    </strong>
                                </p>
                            </div>

                            <div class="form-group">
                                <label for="server">Избери сървър</label>
                                {!! Form::select('server', $servers, null, ['placeholder'=>'Избери сървър за да се конфигурира','class'=>'form-control','id'=>'server']); !!}
                            </div>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-success btn-sm" type="submit"><b class="fa fa-download"></b> Направи
                                конфигурация
                            </button>
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection

