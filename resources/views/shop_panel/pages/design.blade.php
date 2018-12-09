@extends('shop_panel.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Дизайн
        </h1>
    </section>

    <div class="row">
        <section class="content">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-picture-o"></b> Смени дизайна</h3>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <div class="form-group">
                            <label for="design-form"><b class="fa fa-picture"></b> Избери дизайн</label>
                            {!!
                            Form::select(
                            'design',$designs, $site->settings()->where('key','theme')->first()->value,
                            [
                            'class' => 'form-control',
                            'id' => 'design-form',
                            ]
                            )
                            !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-copyright"></b> Смени логото</h3>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <div class="form-group">
                            <center>
                                <img id="logo-img" width="350" src="{{ $site->settings()->where('key','logo')->first()->value }}"/>
                                <br>
                            </center>
                            <label for="logo"><b class="fa fa-picture"></b> Лого</label>
                            <input class="form-control" name="logo" id="logo" placeholder="http://placehold.it/logo.png"
                                   value="{{ $site->settings()->where('key','logo')->first()->value }}">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-eye"></b></h3>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="preview-design" class="embed-responsive-item"
                                    src="http://{{ $site->slug }}.{{ env('PLAIN_URL') }}"></iframe>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </section>
    </div>

@endsection