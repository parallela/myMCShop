@extends('shop_panel.layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Менюта
            <div class="add pull-right" data-toggle="modal" data-target="#createSidebar">
                <button data-toggle="tooltip" data-placement="top" title="Добави меню"
                        data-to class="btn btn-info btn-xs"><b class="fa fa-plus"></b></button>
            </div>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            @include('shop_panel.modals.create_sidebar')
            <div id="errorDiv" style="display: none;" class="col-md-12 alert alert-danger">
                <ul>
                    <li id="errorDesc"></li>
                </ul>
            </div>
            @if ($errors->any())
                <div id="errorDiv" class="col-md-12 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li id="errorDesc">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-7" id="move-sidebar">
                @foreach($sidebars as $sidebar)
                    <div id="id-{{ $sidebar->id }}" class="box box-info collapsed-box" style="cursor: move;">
                        <div class="box-header with-border">
                            <h3 class="box-title"
                                onclick="changeTitle({{ $sidebar->id }})" style="cursor: pointer;">
                                <div id="s-name-{{ $sidebar->id }}" data-toggle="tooltip"
                                     title="Цъкни за да промениш заглавието!" style="display: inline">
                                    {{ $sidebar->name }}
                                </div>
                                {!! $sidebar->type != "custom" ? '<span class="badge badge-info">Статично</span>' : ''  !!}
                            </h3>

                            <div class="box-tools pull-right">
                                <button type="button" onclick="deleteSidebar({{ $sidebar->id }})"
                                        class="btn btn-box-tool"><i
                                            class="fa fa-trash-o"></i>
                                </button>
                                <button type="button" onclick="hideSidebar({{ $sidebar->id }})"
                                        class="btn btn-box-tool">
                                    <i class="fa fa-eye {{ $sidebar->show == 1 ? '' : 'text-danger' }}"
                                       id="hideicon-sidebar-{{ $sidebar->id }}"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            @if($sidebar->type != "custom")
                                <b class="fa fa-picture-o"></b> Това меню е статично и не може да бъде променено!
                            @else
                                <textarea name="new_content_{{ $sidebar->id }}">{{ $sidebar->content }}</textarea>
                                <script>
                                    CKEDITOR.replace('new_content_{{ $sidebar->id }}');
                                </script>

                                <br>

                                <div class="form-group text-center">
                                    <button type="button" onclick="changeContent({{ $sidebar->id }})"
                                            class="btn btn-success btn-sm"><b
                                                class="fa fa-refresh"></b> Обнови
                                    </button>
                                </div>
                            @endif
                        </div>
                        <!-- /.box-body -->
                    </div>
            @endforeach
            <!-- /.box -->
            </div>
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-rebel"></b> Показани потребители в скорощни покупки</h3>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <div class="form-group">
                            <input type="number" id="show_log_amount" class="form-control" placeholder="1" value="{{ $site->settings()->where('key','show_log_amount')->first()->value }}">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-money"></b> Приходи</h3>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <div class="form-group">
                            <label for="text">Текст</label>
                            <input type="text" class="form-control" id="donation_text" placeholder="Трябват ни X за да подържаме сървъра онлайн" value="{{ $site->settings()->where('key','donation_goal_text')->first()->value }}">
                        </div>
                        <div class="form-group">
                            <label for="donation_goal">Нужна сума</label>
                            <input type="number" class="form-control" id="donation_goal"  placeholder="X" value="{{ $site->settings()->where('key','donation_goal')->first()->value }}">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection