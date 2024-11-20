@extends('layouts.page')
@section('title','Register')
@section('content')
    <div class="register">
        <h2>Register to Become a Member</h2>
        <form id="signupForm">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <br> <br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="e.g., something@something.com">

            <br> <br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="8">

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <br> <br>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required pattern="^\+44\d{10,13}$" placeholder="e.g., +44 1234 567890">

            <br> <br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <br> <br>

            <button type="submit">Sign Up</button>
        </form>
    </div>
@endsection


<!-- If looking for css its in public/css/style.css under .register -->
