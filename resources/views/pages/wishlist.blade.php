@extends('layouts.page')
@section('title', 'Wishlist')
@section('content')
    <div class="wishlist">
        <h1>Wishlist</h1>
        <h2>Your wishlist</h2>
        
        <section>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Remove</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($wishlistItems as $item)
                        <tr>
                            <!-- Adjust how you retrieve the product image, name, etc. -->
                            <td>
                                <img src="{{ $item->product->getMainImage() }}" 
                                     alt="{{ $item->product->name }}" 
                                     width="50">
                            </td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->size }}</td>
                            <td>£{{ number_format($item->product->price, 2) }}</td>
                            <td>
                                <!-- Optional: If you allow updating quantity in the wishlist -->
                                <form action="{{ route('wishlist.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" 
                                           value="{{ $item->quantity }}" 
                                           min="1" max="10">
                                    <button type="submit">Update</button>
                                </form>
                            </td>
                            <td>
                                <!-- Route to remove the item from the wishlist -->
                                <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Remove</button>
                                </form>
                            </td>
                            <td>£{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Your wishlist is empty!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Wishlist summary (optional) -->
            <div class="wishlist-summary">
                <h3>Wishlist Totals</h3>
                <p>Subtotal: £{{ number_format($total, 2) }}</p>
                <p>Shipping: Free</p>
                <p><strong>Total: £{{ number_format($total, 2) }}</strong></p>

                <!-- You could provide a route to move all wishlist items to the basket, 
                     or proceed directly to checkout if desired. -->
                <a href="/basket">
                    <button>Move Wishlist to Basket</button>
                </a>
            </div>
        </section>
    </div>
@endsection