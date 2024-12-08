@extends('layouts.page')
@section('title', 'Forgot-pass')
@section('content')

<div class="change">
    <h2>Change Your Password</h2>

    <div class="reset-sections">
        <h3>Need to change your password? Please enter a new password below: </h3>

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('change-pass.change') }}">
            @csrf
            <label for="password">New Password</label><br>
            <input type="password" id="password" name="password" required/><br>
            <label for="password_confirmation">Confirm</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" required/><br>

            <button type="submit">Change Password</button>
        </form>
    </div>
</div>
@endsection
