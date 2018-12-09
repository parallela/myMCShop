@extends('shop_panel.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Купони
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-{{ count($coupons) != 0 ? '6' : '12' }}">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-plus"></b> Добави купон на потребител</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <form method="post" id="create-coupon">
                        @csrf
                        @method('PUT')
                        <div class="box-body" style="">
                            <div class="form-group">
                                <label for="coupon-to-user">Купона ще бъде на:</label>
                                <input type="text" class="form-control" id="coupon-to-user" name="user"
                                       placeholder="Потребителско име"
                                       maxlength="16" minlength="3"
                                       onpaste="return false;">
                            </div>
                            <div class="form-group">
                                <label for="budget">Бюджет:</label>
                                <input type="number" class="form-control" id="budget" name="budget" placeholder="Бюджет"
                                       onpaste="return false;">
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
            @if(count($coupons) != 0)
                <div class="col-md-6">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Активни купони в момента</h3>

                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <table id="coupon-datatable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Код на купона</th>
                                    <th>Потребител</th>
                                    <th>Бюджет (Лева)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupons as $coupon)
                                    <tr id="{{ $coupon->id }}">
                                        <td>{{ $coupon->id }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{!!
                                     $coupon->user->username == null
                                     ?
                                     'Няма потребител :('
                                     :
                                     '<img src="https://minotar.net/helm/'.$coupon->user->username.'/16.png" width="16px;" height="16px;" /> '.$coupon->user->username  !!}</td>
                                        <td>{{ $coupon->budget }}</td>
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

