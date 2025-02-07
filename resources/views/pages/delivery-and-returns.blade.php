@extends('layouts.page')

@section('title', 'Delivery and Returns')

@section('script')
    <script src="{{ asset('/js/delivery-and-returns.js') }}"></script>
@endsection

@section('content')
    <div class="container my-5">
        <h1>Delivery and Returns</h1>

        <section class="delivery-info">
            <h2>Delivery Information</h2>
            <p>
                We offer various delivery options to meet your needs. Our delivery services include:
            </p>
            <ul>
                <li><strong>Standard Delivery</strong> (3-5 business days): £3.99</li>
                <li><strong>Next Day Delivery</strong> (order by 9 PM): £5.99</li>
                <li><strong>Free Delivery</strong> on orders over £75</li>
            </ul>
          