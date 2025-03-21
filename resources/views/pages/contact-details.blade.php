@extends('layouts.page')
@section('title', 'Contact Details')
@section('script', asset('js/contact-details.js'))
@section('content')
    <div class="contact-details">
        <h1>Your Details</h1>
        <div class="contact-details-form">
            <form id="details-form" method="post" action="{{ route('account.update') }}" novalidate>
                @csrf

                <div class="form-group">
                    <label for="first-name-new">First Name:</label>
                    <input type="text" id="first-name-new" name="first-name" value="{{ $user['first_name'] }}" required>
                    <input type="hidden" id="first-name-old" value="{{ $user['first_name'] }}">
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="last-name-new">Last Name:</label>
                    <input type="text" id="last-name-new" name="last-name" value="{{ $user['last_name'] }}" required>
                    <input type="hidden" id="last-name-old" value="{{ $user['last_name'] }}">
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="email-new">Email:</label>
                    <input type="email" id="email-new" name="email" value="{{ $user['email'] }}" required>
                    <input type="hidden" id="email-old" value="{{ $user['email'] }}">
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="phone-number-new">Phone Number:</label>
                    <input type="text" id="phone-number-new" name="phone-number" value="{{ $user['phone_number'] }}" required>
                    <input type="hidden" id="phone-number-old" value="{{ $user['phone_number'] }}">
                    <span class="error-message"></span>
                </div>

                <div class="contact-detail-button">
                    <button type="submit" class="btn btn-primary mt-4">Update Details</button>

                    <!-- Delete Account Button -->
                    <button type="button" class="btn btn-danger mt-4" onclick="confirmDelete()">Delete Account</button>
                </div>
            </form>

            <!-- Hidden Delete Account Form -->
            <form id="delete-account-form" method="POST" action="{{ route('account.delete') }}" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection
