@extends('layouts.page')
@section('title','Review')
@section('content')
<div class="review">
    <!-- Need a form submission --> 
    <h1>Create Review</h1>
    <!-- Image + Name of Product -->
    <img></img>
    <p></p>
    <br>
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
    <br>
    <h2>Add a headline</h2>
    <!-- Input for headline -->
    <input></input>
    <br>
    <h2>Add a written review</h2>
    <!-- Input for review -->
    <input></input>
    <br>
    <p>We will notify you via email as soon as your review is processed.<p>
    <!-- Submit button -->
    <button>Submit</button> 
</div>
@endsection
