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
            @if($orders)
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
                                    <img src="{{$individualOrder->product->getMainImage()}}">
                                    <div class="item-details">
                                        <p class="item-name">{{$individualOrder->product->name}}</p>
                                        <p class="item-price">{{$individualOrder->getSubtotal}}</p>
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

                    <!-- Order 2-->
                    <div class="order">
                        <div class="order-info">
                            <p class="order-date">Order placed: 1st February 2025</p>
                            <p class="dispatch-to">Dispatched to: 2 Aston Uni</p>
                            <p class="order-price">Total: £55.00</p>
                        </div>


                        <div class="order-items">
                            <div class="item">
                                <!--item 1 of second order details-->
                                <img src="{{asset("images/productImage/8573ac4b-e2c8-4ea3-8909-f60126839a3c.jpg")}}">
                                <div class="item-details">
                                    <p class="item-name">Pulse Track Running Shoes</p>
                                    <p class="item-price">£20.00</p>
                                </div>
                            </div>

                            <!-- item 2 of second order-->
                            <div class="item">
                                <img src="{{asset("images/productImage/68313941-69f1-4bf9-bb02-de3a64caa29f.jpg")}}">
                                <div class="item-details">
                                    <p class="item-name">Velocity Running Shoes </p>
                                    <p class="item-price">£35.00</p>
                                </div>
                            </div>
                        </div>

                        <!-- buttons for order 2-->
                        <div class="order-actions">
                            <button class="button">Buy again</button>
                            <button class="button">Order Details</button>
                            <button class="button">Leave a review</button>
                        </div>
                    </div>

                </div>
            @else
                <p>No previous orders found</p>
            @endif
        </div>
    </div>

@endsection
