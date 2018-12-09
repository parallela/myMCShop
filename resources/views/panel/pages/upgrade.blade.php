@extends('panel.layouts.app')
@section('content')

    <section class="content-header">
        <h1>
            Ъпгрейд
        </h1>
    </section>

    <div class="row">
        <section class="content">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-link"></b> Изберете сайт</h3>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <form method="post" action="{{ route('manage.siteupgrade') }}">
                        @csrf
                        <div class="box-body" style="">
                            <div class="text-center">
                                <div class="alert alert-info"><b class="fa fa-info"></b> Моля изберете сайт от менюто
                                    по-долу за да продължите!
                                </div>
                                <div class="form-group">
                                    {{ Form::select('site_id', $sites->pluck('slug','id'), null, ['class'=>'form-control','placeholder' => 'Изберете сайт за ъпгрейд!']) }}
                                </div>
                                <button type="submit" class="btn btn-info btn-sm"><b
                                            class="fa fa-arrow-circle-o-right"></b> Продължи
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </section>
    </div>

@endsection