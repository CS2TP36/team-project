@extends('layouts.page')
@section('title','Contact Details')
@section('script', asset('js/contact-details.js'))

@section('content')
    <div class="contact-details">
        <h1>Your Details</h1>
        <div class="contact-details-form">
            <!-- Needs a controller -->
            <form id="details-form" method="post" action="{{ route('account.update') }}">
                @csrf
                <h2>First Name</h2>
                <input type="text" id="first-name-new" name="first-name" value="{{ $user['first_name'] }}"
                       required></input>
                <input type="hidden" id="first-name-old" value="{{ $user['first_name'] }}">
                <div class="contact-line-break"><br></div>

                <h2>Last Name</h2>
                <input type="text" id="last-name-new" name="last-name" value="{{ $user['last_name'] }}"
                       required></input>
                <input type="hidden" id="last-name-old" value="{{ $user['last_name'] }}">
                <div class="contact-line-break"><br></div>

                <h2>Email</h2>
                <input type="email" id="email-new" name="email" value="{{ $user['email'] }}" required></input>
                <input type="hidden" id="email-old" value="{{ $user['email'] }}">
                <div class="contact-line-break"><br></div>

                <h2>Phone Number</h2>
                <input type="text" id="phone-number-new" name="phone-number" value="{{ $user['phone_number'] }}"
                       required></input>
                <input type="hidden" id="phone-number-old" value="{{ $user['phone_number'] }}">
            </form>
            
            <div class="contact-line-break"><br></div>
            <div class = contact-detail-button>
                <button type="submit" form="details-form" class="btn btn-primary mt-4">Update Details</button>

                <!-- Delete Account Button -->
                <button type="button" class="btn btn-danger mt-4" onclick="confirmDelete()">Delete Account</button>
            </div>
            <!-- Hidden Delete Account Form -->
            <form id="delete-account-form" method="POST" action="{{ route('account.delete') }}" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure? This action is irreversible.')) {
                document.getElementById('delete-account-form').submit();
            }
        }
    </script>
@endsection