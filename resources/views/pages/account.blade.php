@extends('layouts.page')
@section('title','Account')
@section('content')
    <div class="account-page">
        <div class="container">
            <h1>Your Account</h1>
            <!-- Grid to contain the "cards" -->
            <div class="grid">
                <!-- Link to Contact Details Page -->
                <a href="{{ route('account.contact-details') }}" class="card">
                    <img src="images/details-icon.png" alt="Details">
                    <div class="card-content">
                        <h2>Your Details</h2>
                        <p>First name, Last name, Email address</p>
                    </div>
                </a>
                <!-- Link to Previous Orders Page -->
                <a href="/orders" class="card">
                    <img src="images/orders-icon.png" alt="Orders">
                    <div class="card-content">
                        <h2>Your Previous Orders</h2>
                        <p>View your orders, leave a review or buy again</p>
                    </div>
                </a>
                <!-- Link to Account-Addresses Page -->
                <a href="/account/addresses" class="card">
                    <img src="images/addresses-icon.png" alt="Addresses">
                    <div class="card-content">
                        <h2>Your Addresses</h2>
                        <p>Edit, remove or set default address</p>
                    </div>
                </a>
                <!-- Link to Account-Payments Page -->
                <a href="{{ route('account.payments') }}" class="card">
                    <img src="images/account-payment-icon.png" alt="Payments">
                    <div class="card-content">
                        <h2>Your Payment Methods</h2>
                        <p>View, add, and manage your saved payment methods</p>
                    </div>
                </a>
                <!-- Link to Change Password Page -->
                <a href="/change-pass" class="card">
                    <img src="images/security-icon.png" alt="Security">
                    <div class="card-content">
                        <h2>Login & Security</h2>
                        <p>Manage password</p>
                    </div>
                </a>

                @if(Auth::user()->isAdmin())
                    <!-- Link to Admin Page -->
                    <a href="/admin" class="card">
                        <img src="images/admin.png" alt="Admin">
                        <div class="card-content">
                            <h2>Admin</h2>
                            <p>The admin pages</p>
                        </div>
                    </a>
                @endif

                <a href="/logout" class="card">
                    <img src="images/logout.png" alt="Security">
                    <div class="card-content">
                        <h2>Sign out</h2>
                        <p>Sign of your account</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
