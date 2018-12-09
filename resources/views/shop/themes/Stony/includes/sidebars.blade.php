@if(Auth::guard('mcuser')->user())
    @include('shop.themes.'.$theme.'.includes.userorders_modal',compact('userOrders'))
    @foreach($sidebars as $sidebar)
        @if($sidebar->show != 0)
            <div class="panel panel-default module">
                <div class="panel-heading">{{ $sidebar->name }}</div>
                <div class="panel-body">
                    @if($sidebar->type == "upanel")
                        <div class="text-center">
                            <img src="https://minotar.net/avatar/{{ Auth::guard('mcuser')->user()->username }}"
                                 width="50"
                                 height="50"><br>
                            <b>{{ Auth::guard('mcuser')->user()->username }}</b>
                            <hr/>

                            <b class="fa fa-user"></b> @lang('messages.registered'):
                            <b>{{ Auth::guard('mcuser')->user()->created_at->toFormattedDateString() }}</b><br>
                            <b class="fa fa-money"></b> @lang('messages.donated'):
                            <b>{{ session()->get('currency') == 'EUR' ? floor($donatedPrice/1.95) : $donatedPrice }}</b>
                            {{ session()->has('currency') ? session()->get('currency') : 'BGN' }}<br>
                            <b class="fa fa-shopping-basket"></b> @lang('messages.lastp'):
                            <b>{{$lastPurchase }}</b>
                            <br>
                            <b class="fa fa-calendar"></b> @lang('messages.lastpon'): <b>{{ $lastPurchaseDate }} </b>
                            <br>
                            <b class="fa fa-shopping-bag"></b> @lang('messages.urpurchase'):
                            <b>{{ empty(Auth::guard('mcuser')->user()->orders->where('site_id',$site->id)->count()) ? '0' : Auth::guard('mcuser')->user()->orders->count() }}</b>
                            <br>
                            <b class="fa fa-shopping-cart"></b> @lang('messages.urpurchaselist'):
                            <button data-toggle="modal" data-target="#orders" class="btn btn-default btn-xs"><b
                                        class="fa fa-eye"></b></button>
                            <hr/>
                        </div>
                    @elseif($sidebar->type=="status")
                        @if(isset($s_status))
                            <div class="server-status">
                                <img src="{{ array_key_exists('favicon', $s_status) ? $s_status['favicon'] : '' }}"
                                     width="64px" height="64px">
                                <p>
                                <h4>{{ $ip[1] == "25565" ? $ip[0] : $ip[0].':'.$ip[1] }}</h4>
                                </p>
                                <hr/>
                                <p>
                                    {{ $s_status['players']['online'] }}
                                    / {{ $s_status['players']['max'] }} @lang('messages.onlineplayers').
                                </p>
                                <p>
                                    @lang('messages.version'): {{ $s_status['version']['name'] }} <br>
                                </p>
                            </div>
                        @else
                            <p>
                            <center><h4><b class="fa fa-warning faa-flash animated "></b>
                                    @lang('messages.server.offline') </h4>
                                <br>
                                <b class="fa fa-arrow-circle-right faa-ring animated"></b>
                                @lang('messages.server.try')
                                <b>{{ $ip[1] == "25565" ? $ip[0] : $ip[0].':'.$ip[1] }}</b>
                            </center>
                            </p>
                        @endif
                    @elseif($sidebar->type=="lpurchase")
                        @if(count($latestorders) > 0)
                            <ul class="payments">
                                @foreach($latestorders as $order)
                                    <li>
                                        <div data-toggle="tooltip" data-html="true" data-original-title="
                                        <b class='fa fa-calendar-o'></b> {{ $order->created_at->format('d/m/Y | G:i') }}"
                                             data-placement="left">
                                            <div class="avatar">
                                                <img src="https://cravatar.eu/avatar/{{ $order->user->username }}/64"
                                                     width="28">
                                            </div>
                                            <div class="info">
                                                <div class="ign">
                                                    {{ $order->user->username }}
                                                </div>
                                                <div class="extra">
                                                    {{ $order->product->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="info">
                                <center><h4>@lang('messages.noLPurchases')</h4></center>
                            </div>
                        @endif
                    @elseif($sidebar->type=="recpackate")
                        @if(!empty($recommended))
                            @include('shop.themes.'.$theme.'.includes.product_modal',['product'=>$recommended])
                            <div class="featured-package">
                                <div class="image" data-toggle="tooltip"
                                     data-original-title="@lang('messages.tooltip')">
                                    <a data-toggle="modal" data-target="#p{{ $recommended->id }}">
                                        <img src="{{$recommended->image}}" class="img-rounded">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="text">
                                        <div class="name">{{$recommended->name}}</div>
                                        <div class="price">
                                            {{ session()->get('currency') == 'EUR' ? floor($recommended->price/1.95) : $recommended->price }}
                                            <small>{{ session()->has('currency') ? session()->get('currency') : 'BGN' }}
                                                {!! $recommended->discount != null ? '<span class="label label-danger">'.$recommended->discount.'%</span>' : '' !!}</small>
                                        </div>
                                    </div>
                                    <div class="button">
                                        <a data-toggle="modal" data-target="#p{{ $recommended->id }}"
                                           class="btn btn-info btn-sm btn-block toggle-modal">@lang('messages.buybtn')</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="info">
                                <center><h4>@lang('messages.noRPackate')</h4></center>
                            </div>
                        @endif
                    @elseif($sidebar->type=="payments")
                        <div class="progress  progress-striped">
                            <div class="progress-bar progress-bar-danger" role="progressbar"
                                 aria-valuenow="{{ session()->get('currency') == 'EUR' ? floor($donationAmount/1.95) : $donationAmount }}"
                                 aria-valuemin="0"
                                 aria-valuemax="{{ session()->get('currency') == 'EUR' ? floor($donationGoal/1.95) : $donationGoal }}">
                            </div>
                        </div>
                        <div class="text-center"><b class="fa fa-money"></b> <b>
                                {{ session()->get('currency') == 'EUR' ? floor($donationAmount/1.95) : $donationAmount }}
                                /
                                {{  session()->get('currency') == 'EUR' ? floor($donationGoal/1.95) : $donationGoal }}

                                {{ session()->has('currency') ? session()->get('currency') : 'BGN' }}
                            </b>
                        </div>
                        <hr/>
                        <div class="text-center">{{ $donationGoalText }}</div>
                    @elseif($sidebar->type=="custom")
                        {!! $sidebar->content  !!}
                    @endif
                </div>
            </div>
        @endif
    @endforeach
@else
    <div class="panel panel-default module">
        <div class="panel-heading"><b class="fa fa-warning"></b> @lang('messages.swr')</div>
        <div class="panel-body text-center">
            <img width="250px" height="250px;" src="{{ asset('/images/security.png') }}">
            @lang('messages.ltc')
        </div>
    </div>
@endif