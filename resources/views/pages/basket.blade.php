@extends('layouts.page')
@section('title', 'Basket')
@section('content')
    <div class="basket">
        <!-- <h1>Basket</h1> -->
        <section class="basket-container">
            <div class="basket-details">
                <h2>Your Basket</h2>
                <div class="line-break"></div>
                <!-- All Basket items are iterated over one by one -->
                @forelse($basketItems as $item)
                    <!-- Contains each basket item -->
                    <div class="basket-item">
                        <!-- Contains the Image of the item and the remove button -->
                        <div class="item-image">
                            <img src="{{ $item->product->getMainImage() }}" alt="{{ $item->product->name }}"></img>

                            <form action="{{ route('basket.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                        <!-- Contains the product name, price and size -->
                        <div class="b-item-details">
                            <p>{{ $item->product->name }}</p>
                            <p><strong>£{{ number_format($item->product->price * $item->quantity, 2) }}</strong></p>
                            <p>Size: {{ $item->size }}</p> <!-- Display size -->
                        </div>
                        <!-- Contains the quantity of the item and the update button -->
                        <div class="item-quantity">
                            <form action="{{ route('basket.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="10">
                                <button type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                    <!-- Text displayed if the Basket has no items -->
                @empty
                    <p>Your basket is empty!</p>
                @endforelse
            </div>
            <!-- Contains the subtotal cost of the basket and the total cost of basket including shipping  -->
            <div class="basket-summary">
                <p>Subtotal: £{{ number_format($total, 2) }}</p>
                <div class="line-break"></div>
                <p>Shipping: Free</p>
                <div class="line-break"></div>
                <p><strong>Total: £{{ number_format($total, 2) }}</strong></p>
                <div class="line-break"></div>
                <a href="/checkout">
                    <button>Proceed to Checkout</button>
                </a>
                <!-- Link for Privacy Policy -->
                <p>We will use your information in accordance with our (<a href="/privacy-policy">Privacy Policy</a>).
                    Updated January 2025</p>
            </div>
        </section>
    </div>
@endsection


