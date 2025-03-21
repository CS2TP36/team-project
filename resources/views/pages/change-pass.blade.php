@extends('layouts.page')
@section('title', 'Forgot-pass')
@section('script', asset('js/changepass.js'))
@section('content')

    <div class="change">
        <div class="reset-sections">
            <h2>Change Your Password</h2>
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

            <form id="changepassForm" method="POST" action="{{ route('change-pass.change') }}" novalidate>
                @csrf

                <div class="form-group">
                    <label for="password">New Password *</label>
                    <input type="password" id="password" name="password" required/><br>
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm *</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required/><br>
                    <span class="error-message"></span>
                </div>

                <button type="submit">Change Password</button>
            </form>
        </div>
    </div>
@endsection
