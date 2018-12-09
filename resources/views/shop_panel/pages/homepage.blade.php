@extends('shop_panel.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Начална страница
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-home"></b> Начална страниц</h3>
                    </div>
                    <form method="post" id="updateHomepage">
                        @csrf
                        <div class="box-body" style="">
                            <div class="form-group">
                                <label for="title">Заглавие</label>
                                <input type="text" id="title" class="form-control" name="title"
                                       value="{{ $homepage->title }}">
                            </div>
                            <div class="form-group">
                                <label for="content">Съдържание</label>
                                <textarea name="content" id="content">{{ $homepage->content }}</textarea>
                                <script>CKEDITOR.replace('content')</script>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-sm"><b class="fa fa-save"></b> Запамети
                            </button>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection

