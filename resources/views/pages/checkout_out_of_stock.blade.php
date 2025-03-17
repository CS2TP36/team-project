@extends('layouts.page')
@section('title', 'Out of Stock Items')

@section('content')
<div style="max-width: 600px; margin: 0 auto; padding: 1em;">
    <h3 style="margin-bottom: 1em;">Some items in your basket are out of stock!</h3>
    <p>The following items do not have enough stock:</p>
    <ul style="list-style-type: disc; margin-left: 2em; margin-bottom: 1em;">
        @foreach($outOfStockItems as $item)
            <li>
                <strong>{{ $item->product ? $item->product->name : 'Unknown Product' }}</strong>
                – Requested: {{ $item->quantity }}, Available: {{ $item->product ? $item->product->stock : 0 }}
            </li>
        @endforeach
    </ul>

    <p>Please choose an action:</p>

    <!-- Form to remove out-of-stock items from the basket -->
    <form action="{{ route('basket.removeOutOfStock') }}" method="POST" style="margin-bottom: 1em;">
        @csrf
        <button type="submit" style="
            background-color: #007bff; 
            color: white; 
            padding: 0.5em 1em; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer;
        ">
            Remove Out-of-Stock Items
        </button>
    </form>

    <!-- Link to cancel the order and return to the basket -->
    <a href="{{ route('basket.index') }}" style="
        display: inline-block; 
        background-color: #6c757d; 
        color: white; 
        padding: 0.5em 1em; 
        border-radius: 4px; 
        text-decoration: none;
    ">
        Cancel Order
    </a>
</div>
@endsection