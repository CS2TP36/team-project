@extends('layouts.page')
@section('title','Contact Details')
@section('content')
    <div class="contact-details">
        <h1>Your Details</h1>
        <div class="contact-details-form">
            <!-- Needs amending -->
            <form method="POST" action="{{ route('review.add') }}">
                @csrf
                <h2>First Name</h2>
                <input type="text" placeholder="What's most important to know?" name="first-name"></input>
                <div class="line-break"><br></div>
                
                <h2>Last Name</h2>
                <input type="text" placeholder="What's most important to know?" name="last-name"></input>
                <div class="line-break"><br></div>
                
                <h2>Email</h2>
                <input type="text" placeholder="What's most important to know?" name="email"></input>
                <div class="line-break"><br></div>
                
                <h2>Phone Number</h2>
                <input type="text" placeholder="What's most important to know?" name="phone-number"></input>
                
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
