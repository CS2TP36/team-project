@extends('layouts.page')
@section('title','Review')
@section('content')
    <div class="review">
        <div class="review-form">
            <h1>Create Review</h1>
            <form method="POST" action="{{ route('review.add') }}">
                @csrf
                <!-- Image + Name of Product -->
                <div class="review-image">
                    <img src="{{asset($product->getMainImage())}}" alt="Product Image">
                    <p>{{$product->name}}</p>
                </div>
                <div class="review-line-break"><br></div>
                <h2>Overall rating</h2>
                <!-- Stars -->
                <div class="rating" data-rating="0">
                    <span class="star" data-value="1">&#9734;</span>
                    <span class="star" data-value="2">&#9734;</span>
                    <span class="star" data-value="3">&#9734;</span>
                    <span class="star" data-value="4">&#9734;</span>
                    <span class="star" data-value="5">&#9734;</span>
                </div>
                <script src="{{ asset('js/rating.js') }}"></script>
                <div class="review-line-break"><br></div>
                <h2>Add a headline</h2>
                <!-- Input for headline -->
                <input type="text" placeholder="What's most important to know?" name="headline"></input>
                <div class="review-line-break"><br></div>
                <h2>Add a written review</h2>
                <!-- Input for review -->
                <textarea name="message" id="message" cols="10" rows="7"
                        placeholder="What did you like or dislike? What did you use this product for?" required
                        style="resize: none"></textarea>
                <div class="review-line-break"><br></div>
                <p>We will notify you via email as soon as your review is processed.</p>
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <input type="hidden" id="rating-holder" name="rating" value="0">
                <!-- Submit button -->
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
