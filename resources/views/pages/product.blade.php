@extends('layouts.page')
@section('title')
    Product
@endsection
@php
    use App\Models\Product;
@endphp
@section('content')
    <div class="product">
        <!-- Created a left and right container to make working with the page easier-->
        <div class = "left-container">
            <!-- Image of the product -->
            <img src="{{ asset($product->getMainImage()) }}"></img>
        </div>

        <div class = "right-container">
            <div class = "product-info">
                <!-- Title/Name of the product -->
                <h2>{{$product['name']}}</h2>
                <!-- Price of the product -->
                <h2>£{{number_format($product['price'], 2)}}</h2>
            </div>
            <!--<div class = "size-selection">
                <p>Choose size</p>
                ( Three buttons, S, M, L )
                <button type="button">S</button>
                <button type="button">M</button>
                <button type="button">L</button>
            </div> -->
            <div class="purchase-options">
                <!-- Add to Basket -->
                <form action="{{ route('basket.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="size" id="size" value="">
                    <div class="line-break"></div>

                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="10"> ({{$product['stock']}} in stock)


                    <p>Choose size:</p>
                    <button class = "size-selection" type="button" onclick="selectSize('S')">S</button>
                    <button class = "size-selection" type="button" onclick="selectSize('M')">M</button>
                    <button class = "size-selection" type="button" onclick="selectSize('L')">L</button>



                    <button type="submit">Add to Basket</button>
                </form>
                <!-- Add to Wishlist
                <button type="button">Add to Wishlist</button>
                -->
            </div>

            <script>
                const buttons = document.querySelectorAll(".size-selection");

                buttons.forEach(button => {
                    button.addEventListener("click", () => {
                        buttons.forEach(btn => {
                            btn.style.backgroundColor = "#4D4D4D";
                        });
                        button.style.backgroundColor = "#1D1D1D";
                    });
                });

                function selectSize(size) {
                    document.getElementById('size').value = size;
                }
            </script>

            <div class = "detailed-info">
                <!-- Nav bar containing Product Info and Review-->
                <nav></nav>
                <!-- Description of the product -->
                <p><strong>Description:</strong></p>
                <p id="show_description">{{$product['description']}}</p>
                <br>
                <p id="show_colour"><strong>Colour: </strong>{{$product['colour']}}</p>
                <br>
                <p id="show_id"><strong>Item ID: </strong>{{$product['id']}}</p>
            </div>
        </div>
    </div>
@endsection
