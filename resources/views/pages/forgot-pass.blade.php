@extends('layouts.page')
@section('title', 'Forgot Password')
@section('content')

    <div class="forgot-password">
        <h1>Have you forgotten your password?</h1>

        <div class="forgot-password-form">
            <form method="POST" action="{{ route('forgot-pass.change') }}">
                <label for="email">Enter your email</label>
                <input type="email" name="email" placeholder="Email" required>

                <label for="firstInitial lastInitial">Enter your initials for first and last name</label>
                <input type="text" name="firstInitial" placeholder="Your first initial" maxlength="1" minlength="1" onkeyup="this.value = this.value.toUpperCase();" required>

                <input type="text" name="lastInitial" placeholder="Your last initial" maxlength="1" minlength="1" onkeyup="this.value = this.value.toUpperCase();" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
