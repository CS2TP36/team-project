@extends('layouts.page')
@section('script', asset('js/displayRating.js'))
@section('title')
    Product
@endsection
@php
    use App\Models\Product;
    use App\Http\Controllers\ReviewController;
    use App\Models\User;
    // add to the popularity value of the product on viewing
    $product['popularity'] = $product['popularity'] + 1;
    $product->save();
@endphp
@section('content')
    <div class="product">
        <!-- Created a left and right container to make working with the page easier-->
        <div class="left-container">
            <!-- Image of the product -->
            <img src="{{ asset($product->getMainImage()) }}"></img>
        </div>

        <div class="right-container">
            <div class="product-info">
                <!-- Title/Name of the product -->
                <h2>{{$product['name']}}</h2>
                <!-- Price of the product -->
                <h2>£{{number_format($product['price'], 2)}}</h2>
            </div>

            <div class="purchase-options">
                <!-- Add to Basket -->
                <form action="{{ route('basket.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="size" id="size" value="">
                    <div class="line-break"></div>

                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" required>
                    @if($product->stock > 0) ({{$product['stock']}} in stock) @else() (Out of stock) @endif

                    <p>Choose size:</p>
                    <button class="size-selection" type="button" onclick="selectSize('S')">S</button>
                    <button class="size-selection" type="button" onclick="selectSize('M')">M</button>
                    <button class="size-selection" type="button" onclick="selectSize('L')">L</button>

                    <button type="submit" @if($product->stock < 1) disabled style="background-color: var(--alt-bh-colour)" @endif>Add to Basket</button>

                </form>

                <!-- Add to Wishlist -->
                <form action="{{ route('wishlist.add') }}" method="POST">
                    @csrf
                    <!-- Hidden fields for product ID and size -->
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="size" id="wishsize" value="">

                    <!-- Submit button -->
                    <button type="submit">Add to Wishlist</button>
                </form>
            </div>

            <script src="{{ asset('js/size-selection.js') }}"></script>


            <!-- Nav bar containing Product Info and Review-->
            <nav>
                <ul>
                    <!-- "Product Info" will be active (underlined) as soon as the page loads-->
                    <li data-target="product-info" class="active">Product Info</li>
                    <li data-target="review">Reviews</li>
                </ul>
            </nav>

            <div id="detailed-info">
                <section id="product-info" class="content-section active">
                    <!-- Description of the product -->
                    <p><strong>Description:</strong></p>
                    <p id="show_description">{{$product['description']}}</p>
                    <br>
                    <p id="show_colour"><strong>Colour: </strong>{{$product['colour']}}</p>
                    <br>
                    <p id="show_id"><strong>Item ID: </strong>{{$product['id']}}</p>
                </section>
                @php($reviews = ReviewController::getReviews($product->id))
                <section id="review" class="content-section">
                    <p><strong>Reviews:</strong></p>
                    <!-- TODO: Probably want to rename classes and do some css to make look nice -->
                    <div class="something">
                        @foreach($reviews->reverse() as $review)
                            <div class="line-break"></div>
                            <p>
                                <strong>User: {{ (User::get()->where('id', $review['user_id'])->first())['first_name'] }}</strong>
                            </p>
                            <!-- <div class="line-break"></div> -->
                            <p><strong>{{$review['title']}}</strong></p>
                            <p>{{$review['review']}}</p>
                            <p id="star-{{ $loop->index }}">{{$review['rating']}}</p>

                            <script>
                                displayStarRating(<?php echo $review['rating']; ?>, 'star-{{ $loop->index }}');
                            </script>
                        @endforeach
                    </div>
                </section>
            </div>
            <!-- This JS file changes the style of the sub headings to make them have a purple colour and an underline once clicked -->
            <script src="{{ asset('js/underline.js') }}"></script>
        </div>
    </div>
@endsection
