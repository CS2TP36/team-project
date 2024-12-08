@extends('layouts.page')
@section('title', 'Order Placed')
@section('content')
    <!-- checks if there is an order and tracking number provided -->
    @if(isset($orderNumber) and  isset($trackingNumber))
        <div id="order-success">
            <h1>Order Placed</h1>
            <p>Order number: {{ $orderNumber }}</p>
            <br>
            <p>Tracking number: {{$trackingNumber}}</p>
        </div>
    @endif
@endsection
