@extends('layouts.page')
@section('title')
    Product
@endsection
@section('content')
    <div class="product">
        
        <div class = "left-container"> 
            <!-- Image of the product -->
            <img src="images/coat.jpg" height="800" width = "800"></img>
        </div>
        
        <div class = "right-container">
            <div class = "product-info">
                <!-- Title/Name of the product -->
                <h2>Really Nice and Intersting Product Name</h2>
                <!-- Price of the product -->
                <h2>£1000</h2>
            </div>

            <div class = "size-selection"> 
                <!-- Three buttons, S, M, L -->
                <button type="button">S</button>
                <button type="button">M</button>
                <button type="button">L</button>
            </div>
        
            <div class = "purchase-options">
                <!-- Two buttons, add to basket and add to wishlist -->
                <button type="button">Add to Basket</button>
                <button type="button">Add to Wishlist</button>
            </div>
        </div>

        <div class = "detailed-info"> 
            <!-- Nav bar containing Product Info and Review-->
            <nav></nav>
            <!-- Description of the product -->
            <p></p>
        </div>
    </div>
@endsection
