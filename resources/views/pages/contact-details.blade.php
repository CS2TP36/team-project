@extends('layouts.page')
@section('title','Contact Details')
@section('content')
    <div class="contact-details">
        <h1>Your Details</h1>
        <div class="contact-details-form">
            <!-- Needs a controller -->
            <form method="POST">
                @csrf
                <h2>First Name</h2>
                <input type="text" placeholder="What's most important to know?" name="first-name" value="{{ $user['first_name'] }}"></input>
                <div class="line-break"><br></div>

                <h2>Last Name</h2>
                <input type="text" placeholder="What's most important to know?" name="last-name" value="{{ $user['last_name'] }}"></input>
                <div class="line-break"><br></div>

                <h2>Email</h2>
                <input type="text" placeholder="What's most important to know?" name="email" value="{{ $user['email'] }}"></input>
                <div class="line-break"><br></div>

                <h2>Phone Number</h2>
                <input type="text" placeholder="What's most important to know?" name="phone-number" value="{{ $user['phone_number'] }}"></input>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
