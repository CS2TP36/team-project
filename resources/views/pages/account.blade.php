@extends('layouts.page')
@section('title','Account')
@section('content')
    <div class="account-page">
        <div class="container">
            <h1>Your Account</h1>
            <!-- Grid told contain the "cards" -->
            <div class="grid">
                <!-- Link to Contact Details Page -->
                <a href="/account/details" class="card">
                    <img src="images/details-icon.png" alt="Details">
                    <div class="card-content">
                        <h2>Your Details</h2>
                        <p>First name, Last name, Email adddress</p>
                    </div>
                </a>
                <!-- Link to Previous Orders Page -->
                <a href="/orders" class="card">
                    <img src="images/orders-icon.png" alt="Orders">
                    <div class="card-content">
                        <h2>Your Previous Orders</h2>
                        <p>Track, return, cancel an order, download invoice or buy again</p>
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
                <!-- Link to Change Password Page -->
                <a href="/change-pass" class="card">
                    <img src="images/security-icon.png" alt="Security">
                    <div class="card-content">
                        <h2>Login & Security</h2>
                        <p>Manage password, email and mobile number</p>
                    </div>
                </a>
                @if(Auth::user()->isAdmin())
                    <!-- Link to Admin Page -->
                    <a href="/admin" class="card">
                        <img src="" alt="Admin">
                        <div class="card-content">
                            <h2>Admin</h2>
                            <p>The admin pages</p>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection

