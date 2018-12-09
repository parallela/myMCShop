@extends('panel.layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Ъпгрейд на сайт {{ $site->slug }}
        </h1>
    </section>

    <div class="row">
        <section class="content">

            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b class="fa fa-link"></b> {{ $site->slug }}</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <h4 class="text-center">
                            Вашият план в момента е: <font color="aqua">{{ $site->plan->name }}</font>
                            <hr/>
                            @if($site->plan->name == $highest_plan_name)
                                <h3 class="text-center"><b class="fa fa-question"></b> Вече си на най-големия план..
                                    Няма на къде повече :/</h3>
                            @else

                                @foreach($plans as $plan)
                                    <div class="col-md-4">
                                        <div class="box box-success">
                                            <div class="box-heading">
                                                <h3 class="text-center">{{ $plan->name }}</h3>
                                            </div>
                                            <div class="box-body text-center">
                                                <p class="lead" style="font-size:20px"><strong>
                                                        {{ $plan->price }}EUR / месец</strong></p>
                                            </div>
                                            <ul class="list-group list-group-flush text-center">

                                                <li class="list-group-item">
                                                    <i class="fa fa-server"></i> {{ $plan->servers }} @lang('content.serverc')
                                                </li>

                                                <li class="list-group-item">
                                                    <i class="fa fa-shopping-cart"></i> {{ $plan->products }} @lang('content.products')
                                                </li>

                                                <li class="list-group-item">
                                                    <i class="fa fa-location-arrow"></i> {{ $plan->categories }} @lang('content.categories')
                                                </li>

                                                <li class="list-group-item">
                                                    <i class="fa fa-{{ $plan->giftcards == 0 ? 'times' : 'gift' }}"></i>
                                                    @lang('content.giftcard')
                                                </li>

                                                <li class="list-group-item">
                                                    <i class="{{ $plan->paypal == 0 ? 'fa' : 'fa' }} fa-{{ $plan->paypal == 0 ? 'times' : 'paypal'}}"></i>
                                                    @lang('content.paypal')
                                                </li>

                                                <li class="list-group-item">
                                                    <i class="fa fa-{{ $plan->upgrades == 0 ? 'times' : 'chart-line'}}"></i>
                                                    @lang('content.upgrades')
                                                </li>

                                                <li class="list-group-item">
                                                    <i class="fa fa-{{ $plan->show_brand == 1 ? 'times' : 'copyright'}}"></i>
                                                    @lang('content.show_brand')
                                                </li>

                                                <li class="list-group-item">
                                                    <i class="fa fa-paint-brush"></i> @lang('content.designs')
                                                </li>

                                                <li class="list-group-item">
                                                    @if(!Auth::check())
                                                        <a href="{{ route('login') }}"
                                                           class="btn btn-block btn-danger text-uppercase">@lang('signup')</a>
                                                    @else
                                                        <form method="post" style="display:inline;"
                                                              action="{{ route('manage.upgradeproccess') }}">
                                                            @csrf
                                                            <input type="hidden" name="p_id" value="{{ $plan->id }}">
                                                            <input type="hidden" name="s_id" value="{{ $site->id }}">
                                                            <button type="submit"
                                                                    class="btn btn-block btn-success text-uppercase">@lang('content.buy')</button>
                                                        </form>
                                                    @endif
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                @endforeach

                            @endif
                        </h4>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </section>
    </div>

@endsection