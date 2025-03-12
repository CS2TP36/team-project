<!-- moved into reusables so it can be used to generate pages of orders -->
@foreach($orders as $order)
    <div class="order">

        <!-- order info including total price, dispatched to adn time order was placed  -->
        <div class="order-info">
            <p class="order-id">Order number: {{ $order["id"] }}</p>
            <p class="order-date">Order placed: {{ $order["created_at"] }}</p>
            <p class="dispatch-to">Dispatched
                to: {{ Shipping::all()->where('id', $order["shipping_id"])->first()["delivery_address"] }}</p>
            <p class="order-price">Total: £{{ number_format($order->calculateTotal(),2) }}</p>
        </div>

        <div class="order-items">
            @foreach($order->individualOrders as $individualOrder)
                <div class="item">
                    <img src="{{ $individualOrder->product()->getMainImage() }}">

                    <!-- product info(name,price and quantity bought) -->
                    <div class="previous-item-details">
                        <p class="item-name">{{ $individualOrder->product()->name }}</p>
                        <!-- php to retreive the info-->
                        <p class="item-price">
                            £{{ number_format($individualOrder->getSubtotal(), 2) }}</p>
                        <p class="item-quantity">Quantity: {{ $individualOrder->quantity }}</p>

                        <!-- buttons for each order -->
                        <div class="order-actions">
                            <button class="button" onclick="location.href = '/product/{{ $individualOrder->product()->id }}'">Buy again</button>
                            <button class="button" onclick="location.href = '/review/{{ $individualOrder->product()->id }}'">Leave a review</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
