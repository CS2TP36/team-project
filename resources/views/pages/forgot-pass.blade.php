@extends('layouts.page')
@section('title', 'Forgot Password')
@section('script', asset('js/forgot.js'))
@section('content')

    <div class="forgot-password">
        <h2>Have you forgotten your password?</h2>

        <div class="forgot-password-form">
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

            @if (session('error'))
                <div class="error-message">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <form id="forgotpassForm" method="POST" action="{{ route('forgot-pass.change') }}" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email">Enter your email</label>
                    <input type="email" name="email" placeholder="Email" required>
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="firstInitial">Enter your initials for first name</label>
                    <input type="text" name="firstInitial" placeholder="Your first initial" maxlength="1" minlength="1" onkeyup="this.value = this.value.toUpperCase();" required>
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="firstInitial">Enter your initials for last name</label>
                    <input type="text" name="lastInitial" placeholder="Your last initial" maxlength="1" minlength="1" onkeyup="this.value = this.value.toUpperCase();" required>
                    <span class="error-message"></span>
                </div>

                <div class="button">
                    <button type="submit">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
