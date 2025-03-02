@extends('layouts.page')
@section('title', 'Basket')
@section('content')
    <div class="basket">
        <!-- <h1>Basket</h1> -->
        <section class="basket-container">
            <div class="basket-details">
                <h2>Your Basket</h2>
                <div class="line-break"></div>
                @forelse($basketItems as $item)
                    <div class="basket-item">
                        <div class="item-image">
                            <img src="{{ $item->product->getMainImage() }}" alt="{{ $item->product->name }}"></img>
                            
                            <form action="{{ route('basket.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                        <div class="item-details">
                            <p>{{ $item->product->name }}</p>
                            <p><strong>£{{ number_format($item->product->price * $item->quantity, 2) }}</strong></p>
                            <p>Size: {{ $item->size }}</p> <!-- Display size -->
                        </div>

                        <div class="item-quantity">
                            <form action="{{ route('basket.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="10">
                                <button type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Your basket is empty!</p>
                @endforelse
            </div>

            <div class="basket-summary">
                <p>Subtotal: £{{ number_format($total, 2) }}</p>
                <div class="line-break"></div>
                <p>Shipping: Free</p>
                <div class="line-break"></div>
                <p><strong>Total: £{{ number_format($total, 2) }}</strong></p>
                <div class="line-break"></div>
                <a href="/checkout"><button>Proceed to Checkout</button></a>
                <!-- Probably should add something about reading terms and conditions before checkout -->
                <p>We will use your information in accordance with our (<a href="/privacy-policy">Privacy Policy</a>). Updated January 2025</p>
            </div>
        </section>
    </div>
@endsection


