@extends('shop_panel.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Нотификации
        </h1>
    </section>

    <div class="row">
        <section class="content">
            <div class="col-md-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-plus-circle"></b> Добавяне на нотификация</h3>
                    </div>
                    <!-- /.box-header -->
                    <form method="post" id="notification_create">
                        @csrf
                        @method('PUT')
                        <div class="box-body" style="">
                            <div class="form-group">
                                <label for="title">Заглавие</label>
                                <input type="text" name="title" id="title" placeholder="ИНФОРМАЦИЯ"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="notification_content">Съдържание</label>
                                <textarea name="notification_content" id="notification_content"></textarea>
                                <script>CKEDITOR.replace('notification_content')</script>
                            </div>
                            <div class="form-group">
                                {!! Form::select(
                                'category',
                                [
                                'Категории' => $categories->pluck('name','id'),
                                'Съб-категории' => $subcategories->pluck('name','id'),
                                ],null,['placeholder'=>'Изберете категория','class'=>'form-control']) !!}
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
                @foreach($notifications as $notification)
                    @include('shop_panel.modals.edit_notification',compact('categories','notification','subcategories'))
                    <div id="notification-{{ $notification->id }}" class="box box-danger">
                        <div class="box-header with-border">
                            <h3 onclick="changeTitleNotification({{ $notification->id }})" class="box-title"
                                style="cursor: pointer;"
                                data-toggle="tooltip" title="Цъкнете за да промените заглавието!">
                                <div style="display: inline;" id="notification-title-{{ $notification->id }}">
                                    {{ $notification->title }}
                                </div>
                                <span class="badge bg-aqua">{{ $notification->category->name }}</span>
                            </h3>

                            <div class="box-tools pull-right">
                                <button type="button" onclick="deleteNotification({{ $notification->id }})"
                                        class="btn btn-box-tool">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                <button type="button" data-toggle="modal" data-target="#editNotification{{ $notification->id }}" class="btn btn-box-tool">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                    </div>
            @endforeach
            <!-- /.box -->
            </div>
        </section>
    </div>

@endsection

