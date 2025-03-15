@extends('layouts.page')
@section('title', 'Order Placed')
@section('content')
    <!-- checks if there is an order and tracking number provided -->
    @if(isset($orderNumber) and  isset($trackingNumber))
        <div class="order-success">
            <h1>Order Has Been Placed</h1>
            <p>Order number: {{ $orderNumber }}</p>
            <br>
            <p>Tracking number: {{$trackingNumber}}</p>
            <h2>Thanks For Uuing SportsWear, we hope you enjoy your clothing!</h2>
        </div>
    @endif
@endsection
