@extends('layouts.page')
@section('title', 'Wishlist')
@section('content')
    <div class="wishlist">
        <!-- <h1>Wishlist</h1> -->
        <section class="wishlist-container">
            <div class="wishlist-details">
                <h2>Your Wishlist</h2>
                <div class="line-break"></div>
                @forelse($wishlistItems as $item)
                    <div class="wishlist-item">
                        <div class="item-image">
                            <img src="{{ $item->product->getMainImage() }}" alt="{{ $item->product->name }}"></img>

                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                        <div class="w-item-details">
                            <p>{{ $item->product->name }}</p>
                            <p><strong>£{{ number_format($item->product->price * $item->quantity, 2) }}</strong></p>
                            <p>Size: {{ $item->size }}</p> <!-- Display size -->
                        </div>

                        <div class="add-basket">
                            <form action="{{ route('basket.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                <input type="hidden" name="size" value="{{ $item->size }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit">Add to Basket</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Your wishlist is empty!</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection


