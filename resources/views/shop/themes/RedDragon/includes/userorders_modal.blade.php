<!-- Modal -->
<div class="modal fade" id="orders" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b class="fa fa-shopping-cart"></b> @lang('messages.urpurchaselist')</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead style="background-color: #5a6268" >
                    <tr>
                        <th scope="col"><b class="fa fa-key"></b> @lang('messages.nofpurchase')</th>
                        <th scope="col"><b class="fa fa-calendar"></b> @lang('messages.pon')</th>
                    </tr>
                    </thead>
                    <tbody  style="background-color: #6c757d">
                    @foreach($userOrders as $order)
                        <tr>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->created_at->format('d/m/Y | H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><b
                            class="fa fa-times"></b> @lang('messages.close')</button>
            </div>
        </div>

    </div>
</div>
