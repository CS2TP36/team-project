@extends('layouts.page')
@section('title','Account')
@section('content')
    <div class="account-page">
        <!--<h1>My Account</h1>-->
        <div class="sidebar">
            <aside>
                <h2>My Account</h2>
                <div class="line-break"><br></div>
                <ul>
                    <li data-target="dashboard" class="active"><a href="#">Dashboard</a></li>
                    <!-- <div class="line-break"><br></div> -->
                    <li data-target="contact-details"><a href="#">Contact Details</a></li>
                    <!-- <div class="line-break"><br></div> -->
                    <li data-target="user-orders"><a href="/orders">My Orders</a></li>
                    <!-- <div class="line-break"><br></div> -->
                    <li><a href="/change-pass">Change Password</a></li>
                    <!-- <div class="line-break"><br></div> -->
                    <li><a href="/logout">Sign Out</a></li>
                    <!-- <div class="line-break"><br></div> -->
                </ul>
            </aside>
        </div>

        <div class="main-content">
            <section id="dashboard" class="content-section active">
                    <!-- Description of the product -->
                    <p><strong>My Account</strong></p>
                    <div class="line-break"><br></div>
                    <p>??? will be displayed here.</p>
            </section>

            <section id="contact-details" class="content-section">
                    <p><strong>Contact Details</strong></p>
                    <div class="line-break"><br></div>
                    <p>Contact Details will be displayed here.</p>
                    <p><strong>Name:</strong> {{$user['first_name']}} {{$user['last_name']}}</p>
                    <p><strong>Email:</strong> {{$user['email']}}</p>
            </section>

            <section id="user-orders" class="content-section">
                    <p><strong>My Orders</strong></p>
                    <div class="line-break"><br></div>
                    <p>Previous Orders will be displayed here.</p>
            </section>
            <script src="{{ asset('js/sidebar-underline.js') }}"></script>
        </div>
    </div>
@endsection

