@extends("layouts.page")
@use(App\Http\Controllers\PreviousOrders)
@use(Illuminate\Support\Facades\Auth)
@use(App\Models\Shipping)
@section("title", "Previous Orders")
@section("content")
    @php($orders = PreviousOrders::getPreviousOrders(Auth::user()))

    <!-- main container -->
    <div id="previous-orders-body">
        <div id="previous-orders">
            <h1>My Previous Orders</h1>
            @if($orders->count() > 0)
                <!--order list section -->
                <div class="orders-list">
                    @foreach($orders as $order)
                        <div class="order">
                            <div class="order-info">
                                <p class="order-date">Order placed: {{ $order["created_at"] }}</p>
                                <p class="dispatch-to">Dispatched to: {{ Shipping::all()->where('id', $order["shipping_id"])->first()["delivery_address"] }}</p>
                                <p class="order-price">Total: {{ $order->calculateTotal() }}</p>
                            </div>

                            <div class="order-items">
                                @foreach($order->individualOrders as $individualOrder)
                                    <!-- Order 1 details-->
                                    <img src="{{$individualOrder->product()->getMainImage()}}">
                                    <div class="item-details">
                                        <p class="item-name">{{$individualOrder->product()->name}}</p>
                                        <p class="item-price">£{{ number_format($individualOrder->getSubtotal(), 2) }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <div class="order-actions">
                                <!-- buttons for order 1 -->
                                <button class="button">Buy again</button>
                                <button class="button">Order Details</button>
                                <button class="button">Leave a review</button>
                            </div>
                        </div>
                    @endforeach
            @else
                <p>No previous orders found</p>
            @endif
        </div>
    </div>

@endsection
