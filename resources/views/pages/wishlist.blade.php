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
                        <th>Remove</th>
                        <th>Add to Basket</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($wishlistItems as $item)
                        <tr>
                            <td>
                                <img src="{{ $item->product->getMainImage() }}" 
                                     alt="{{ $item->product->name }}" 
                                     width="50">
                            </td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->size }}</td>
                            <td>£{{ number_format($item->product->price, 2) }}</td>
                            <td>
                                <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Remove</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('basket.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <input type="hidden" name="size" value="{{ $item->size }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit">Add to Basket</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Your wishlist is empty!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
@endsection
