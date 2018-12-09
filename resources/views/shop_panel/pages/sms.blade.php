@extends('shop_panel.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            SMS
            {{ Form::select('method',$sms_methods,
        $site->settings()->where('key','sms_pay_method')->first()->value)
        ,[
        'placeholder'  =>'Избери метод',
         ]
    }}
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="add_sms">
                    @csrf
                    @method('PUT')
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b class="fa fa-plus"></b> Създай SMS</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <div class="form-group-sm col-md-6">
                                <label for="servID">ServID</label>
                                <input type="text" minlength="1" required="required" name="servID" id="servID"
                                       placeholder="29"
                                       class="form-control">
                            </div>

                            @if($site->settings()->where('key','sms_pay_method')->first()->value == "smspay")
                                <div class="form-group-sm col-md-6">
                                    <label for="userID">UserID</label>
                                    <input type="text" minlength="1" required="required" name="userID" id="userID"
                                           placeholder="1234"
                                           class="form-control">
                                </div>
                            @endif


                            <div class="form-group-sm {{ $site->settings()->where('key','sms_pay_method')->first()->value == "smspay" ? 'col-md-6' : 'col-md-6' }}">
                                <label for="number">Номер</label>
                                <input type="text" minlength="1" required="required" name="number" id="number"
                                       placeholder="1234"
                                       class="form-control">
                            </div>

                            <div class="form-group-sm {{ $site->settings()->where('key','sms_pay_method')->first()->value == "smspay" ? 'col-md-6' : 'col-md-12' }}">
                                <label for="number">Текст</label>
                                <input type="text" minlength="1" required="required" name="text" id="text"
                                       placeholder="XXXX"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-success btn-sm" type="submit"><b class="fa fa-save"></b> Запамети
                            </button>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </form>
                <!-- /.box -->
            </div>
            @if(count($sms_records) != 0)
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b class="fa fa-plus-circle"></b> Създадени SMS-и</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <table class="table table-hover" id="sms-edit">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Текст</th>
                                    <th>Номер</th>
                                    <th>ServID</th>
                                    {!! $site->settings()->where('key','sms_pay_method')->first()->value == "smspay" ? '<th>UserID</th>' : ''!!}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sms_records as $sms)
                                    <tr id="{{ $sms->id }}">
                                        <td>{{ $sms->id }}</td>
                                        <td>{{ $sms->text }}</td>
                                        <td>{{ $sms->number }}</td>
                                        <td>{{ $sms->servID }}</td>
                                        {!! $site->settings()->where('key','sms_pay_method')->first()->value == "smspay" ? '<td>'.$sms->userID.'</td>' : ''!!}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            @endif
        </div>
    </section>
@endsection

