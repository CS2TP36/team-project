@extends("layouts.page")
@use(App\Http\Controllers\PreviousOrders)
@use(Illuminate\Support\Facades\Auth)
@use(App\Models\Shipping)
@section("title", "Previous Orders")
@section("content")
    @php($orders = PreviousOrders::getPreviousOrders(Auth::user()))

    <!-- main container -->
    <div id="previous-orders">
        <h1>My Previous Orders</h1>
        @if($orders->count() > 0)
            
        <!-- Order list section -->
            <div class="orders-list">
                @foreach($orders->reverse() as $order)
                    <div class="order">
                        
        <!-- order info including total price, dispatched to adn time order was placed  -->
            <div class="order-info">
                            <p class="order-date">Order placed: {{ $order["created_at"] }}</p>
                            <p class="dispatch-to">Dispatched to: {{ Shipping::all()->where('id', $order["shipping_id"])->first()["delivery_address"] }}</p>
                            <p class="order-price">Total: £{{ number_format($order->calculateTotal(),2) }}</p>
            </div>

            <div class="order-items">
                    @foreach($order->individualOrders as $individualOrder)
                    <div class="item">
                    <img src="{{ $individualOrder->product()->getMainImage() }}">
                        
        <!-- product info(name,price and quantity bought) -->
            <div class="previous-item-details"> 
                                <p class="item-name">{{ $individualOrder->product()->name }}</p> <!-- php to retreive the info-->
                                <p class="item-price">£{{ number_format($individualOrder->getSubtotal(), 2) }}</p>
                                <p class="item-quantity">Quantity: {{ $individualOrder->quantity }}</p>

        <!-- buttons for each order -->
            <div class="order-actions"> 
                         <button class="button">Buy again</button>
                        <button class="button">Leave a review</button>
                    </div>
                </div>
            </div>
            @endforeach
                        </div> 
                    </div> 
                @endforeach
            </div> 
        @else
            <p>No previous orders found</p>
        @endif
    </div> 
@endsection