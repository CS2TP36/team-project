@extends('layouts.page')
@section('title','Register')
@section('script')
    {{ asset('/js/register-validation.js') }}
@endsection
@section('content')
    <div class="register">
        <h2>Register to Become a Member</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="signupForm" method="POST" action="{{ route('register.store') }}">
            @csrf <!-- Laravel CSRF protection -->
            
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required>
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required>
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="e.g., something@something.com">
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required minlength="8">
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                <span class="error-message"></span> 
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required pattern="^\+44\d{10,13}$" placeholder="e.g., +44 1234 567890 (Needs to be UK)">  
                <span class="error-message"></span> 
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                <span id="addressError" class="error"></span>

            <button type="submit">Sign Up</button>
        </form>
    </div>
@endsection
