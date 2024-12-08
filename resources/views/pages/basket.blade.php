@extends('layouts.page')
@section('title', 'Basket')
@section('content')
<div class="basket">
    <h1>Basket</h1>

    <h2>Your Basket</h2>
    <section>
    
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>size</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Remove</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
    @forelse($basketItems as $item)
        <tr>
            <td><img src="{{ $item->product->getMainImage() }}" alt="{{ $item->product->name }}" width="50"></td>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->size }}</td> <!-- Display size -->
            <td>£{{ number_format($item->product->price, 2) }}</td>
            <td>
                <form action="{{ route('basket.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max= "10">
                    <button type="submit">Update</button>
                </form>
            </td>
            <td>
                <form action="{{ route('basket.remove', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Remove</button>
                </form>
            </td>
            <td>£{{ number_format($item->product->price * $item->quantity, 2) }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7">Your basket is empty!</td>
        </tr>
    @endforelse
</tbody>

        </table>

        <div>
        <div class="basket-summary">
            <h3>Basket Totals</h3>
            <p>Subtotal: £{{ number_format($total, 2) }}</p>
            <p>Shipping: Free</p>
            <p><strong>Total: £{{ number_format($total, 2) }}</strong></p>
            <a href="/checkout"><button>Proceed to Checkout</button></a>
        </div>
    </section>
</div>
@endsection


