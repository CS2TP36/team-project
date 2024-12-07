@extends('layouts.page')
@section('title', 'Forgot-pass')
@section('content')

<div class="change">
    <h2>Change Your Password</h2>

    <div class="reset-sections">
        <h3>Need to change your password? Please enter a new password below: </h3>

            <div class="error-messages">
            </div>

            <div class="error-message">
            </div>

        <form method="POST" action="">

            <label for="email">New Password</label><br>
            <input type="password" id="password" name="passwords" required/><br>
            <label for="email">Confirm</label><br>
            <input type="password" id="confirm_password" name="passwords" required/><br>

            <button type="submit">Change Password</button>
        </form>
    </div>
</div>
@endsection
