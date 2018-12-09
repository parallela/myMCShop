<!-- Modal -->
<div id="p{{ $product->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{!! $product->name !!}</h4>
            </div>
            <div class="modal-body">
                {!! $product->description !!}
            </div>
            <div class="modal-footer">
                @if($product->required_product_id != 0 && !$userOrders->contains('product_id',$product->required_product_id))
                    <button type="button" class="btn btn-warning btn-sm" style="display:inline-block;"
                            data-toggle="tooltip"
                            data-original-title="{!! __('messages.youMustHave',['extra'=>$extras->find($product->required_product_id)->name]) !!}">
                        <b
                                class="fa fa-lock"></b> @lang('messages.infobtn')
                    </button>
                @else
                    @if(!request()->is('cart'))
                        <form id="cartSubmit" style="display: inline" method="post" action="{{ url('/cart') }}">
                            <button type="submit" id="cartGo" class="faa-parent animated-hover btn btn-success btn-sm">
                                <b
                                        class="fa fa-cart faa-bounce"></b><b
                                        class="fa fa-shopping-cart"></b> @lang('messages.buybtn')
                            </button>
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        </form>
                    @endif
                @endif
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><b
                            class="fa fa-times"></b> @lang('messages.close')
                </button>
            </div>
        </div>

    </div>
</div>