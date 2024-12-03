@extends('layouts.page')
@section('title', 'Basket')
@section('content')
<div class="basket">
    <h1>Basket</h1>
    <section>
        <h2>Your Basket</h2>
        <table>
            <thead>
                <tr>
                    <th>Remove</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($basket as $id => $item)
                    <tr>
                        <td>
                            <form action="{{ route('basket.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remove</button>
                            </form>
                        </td>
                        <td><img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" width="50"></td>
                        <td>{{ $item['name'] }}</td>
                        <td>£{{ number_format($item['price'], 2) }}</td>
                        <td>
                            <form action="{{ route('basket.update', $id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>£{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Your basket is empty!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div>
            <h3>Basket Totals</h3>
            <p>Subtotal: £{{ number_format($total, 2) }}</p>
            <p>Shipping: Free</p>
            <p><strong>Total: £{{ number_format($total, 2) }}</strong></p>
            <a href="/checkout"><button>Proceed to Checkout</button></a>
        </div>
    </section>
</div>
@endsection

