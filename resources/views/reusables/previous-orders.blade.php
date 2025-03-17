@use(App\Models\Shipping)
@use(App\Models\Order)
@use(App\Models\IndividualOrder)

@foreach($orders as $order)
    <div class="order">

        <!-- order info including total price, dispatched to, and time order was placed -->
        <div class="order-info">
            <p class="order-id">Order number: {{ $order["id"] }}</p>
            <p class="order-date">Order placed: {{ $order["created_at"] }}</p>

            <p class="dispatch-to">
                Dispatched to:
                {{ 
                    optional(
                        Shipping::all()->where('id', $order["shipping_id"])->first()
                    )["delivery_address"] 
                }}
            </p>

            <!-- Instead of calculateTotal(), show final total from DB: -->
            <p class="order-price">
                Total: £{{ number_format($order->order_total_price, 2) }}
            </p>
        </div>

        <div class="order-items">
            @foreach($order->individualOrders as $individualOrder)
                <div class="item">
                    <img src="{{ $individualOrder->product()->getMainImage() }}">

                    <!-- product info (name, price, quantity) -->
                    <div class="previous-item-details">
                        <p class="item-name">{{ $individualOrder->product()->name }}</p>
                        <p class="item-price">
                            £{{ number_format($individualOrder->getSubtotal(), 2) }}
                        </p>
                        <p class="item-quantity">Quantity: {{ $individualOrder->quantity }}</p>

                        <!-- buttons for each order item -->
                        <div class="order-actions">
                            <button class="button"
                                onclick="location.href = '/product/{{ $individualOrder->product()->id }}'">
                                Buy again
                            </button>
                            <button class="button"
                                onclick="location.href = '/review/{{ $individualOrder->product()->id }}'">
                                Leave a review
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach