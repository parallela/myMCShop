@extends('panel.layouts.app')
@section('content')

    <section class="content-header">
        <h1>
            Профил
        </h1>
    </section>

    <section class="content row">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('/images/user.png') }}"
                             alt="User profile picture">

                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Сайтове</b> <a class="pull-right">{{ Auth::user()->sites()->count() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Вашето IP в момента</b> <a class="pull-right">{{ request()->ip() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Общо дарена стойност</b> <a
                                        class="pull-right">{{ Auth::user()->sites()->get()->sum('plan.price') }}
                                    евро.</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- /.box -->
            </div>
            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-key"></b> Парола</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <form method="post" action="{{ route('manage.changepw') }}">
                    @csrf
                    <!-- /.box-header -->
                        <div class="box-body" style="">

                            @if($errors->has('successpwd'))
                                <div class="alert alert-success">
                                    <b class="fa fa-check"></b>
                                    {{ $errors->first('successpwd') }}
                                </div>
                            @endif

                            @if(!$errors->has('successpwd'))
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            @endif


                            <div class="form-group">
                                <input type="password" class="form-control" name="old_password"
                                       placeholder="Стара парола" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="new_password"
                                       placeholder="Нова парола" required minlength="4">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="new_password_confirm"
                                       placeholder="Повтори новата парола" required minlength="4">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info btn-sm"><b class="fa fa-refresh"></b> Обнови
                            </button>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-5">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-qrcode"></b> 2FA</h3>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <img src="{{ asset('/images/inwork.jpeg') }}" width="150px;" class="center-block">
                        <div class="text-center">
                            <h4>В процен на разработка!</h4>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection