@extends('shop_panel.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Категории
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Създай Категория/Съб-категория</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <form method="POST" action="{{ route('categories.create',$site->slug) }}">
                        @csrf
                        @method('PUT')
                        <div class="box-body" style="">
                            <div class="form-group">
                                <label for="category">Име на категорията</label>
                                <input type="text" name="category" placeholder="Ranks" class="form-control"
                                       id="category">
                            </div>
                            <div class="form-group">
                                <label for="icon">Икона</label>
                                <div role="iconpicker" id="icon" data-rows="12" data-cols="12" data-align="left"></div>
                            </div>
                            @if(count($categories) != 0)
                                <div class="form-group">
                                    <label for="icon">Съб категория?</label>
                                </div>
                                <div class="form-group">
                                    {{
                                    Form::select('subcategory',['true'=>'Да','false'=>'Не'],'false',['class'=>'form-control','id'=>'is-sub'])
                                    }}
                                </div>
                            @endif
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-success btn-sm" type="submit"><b class="fa fa-save"></b> Запамети
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

