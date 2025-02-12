@extends('layouts.page')
@section('title','About Us')
@section('script')
    <script src="{{ asset('js/aboutUs.js') }}" defer></script>
@endsection
@section('content')
<div class="about-page">
    <!-- Banner Section -->
    <section>
        <div id="banner-container">
            <div id="overlay"></div>
            <img src="{{ asset('images/Banner2.PNG') }}" id="banner" alt="About Us Banner">
            <div id="text-banner">
                <p>Dream, Aspire Higher, Achieve Your Destiny.</p>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="content-container">
        <img src="{{ asset('images/About.PNG') }}" class="section-image" alt="About Us Image">
        <div class="text">
            <h2>About Us</h2>
            <p>At Sportswear, we are dedicated to providing top-tier athletic gear that combines comfort, durability,
                and performance...</p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="content-container">
        <img src="{{ asset('images/Mission.PNG') }}" class="section-image" alt="Mission Image">
        <div class="text">
            <h2>Our Mission</h2>
            <p>At Sportswear, our mission is to fill the gap in the market for athletic apparel...</p>
        </div>
    </section>

    <!-- Sportswear Origin -->
    <section class="content-container">
        <img src="{{ asset('images/Origin.PNG') }}" class="section-image" alt="Origin Image">
        <div class="text">
            <h2>Sportswear Origin</h2>
            <p>Sportswear was founded in 2024 by a group of passionate athletes...</p>
        </div>
    </section>

    <!-- What Sets Us Apart -->
    <section class="content-container">
        <img src="{{ asset('images/Unique.PNG') }}" class="section-image" alt="Unique Image">
        <div class="text">
            <h2>What Sets Us Apart</h2>
            <p>At Sportswear, we believe in more than just making high-quality gear...</p>
            <ul>
                <li>Innovative Materials: We use state-of-the-art fabrics...</li>
                <li>Commitment to Sustainability: We focus on eco-friendly processes...</li>
                <li>Designed for Every Athlete: Our gear fits all body types...</li>
            </ul>
        </div>
    </section>

    <!-- Call to Action -->
    <section id="cta">
        <h2>Join the Movement</h2>
        <p>Explore our collection and take your performance to the next level.</p>
        <a href="#">Shop Now</a>
        <p>Follow Us</p>
        <ul>
            <li><a href="#"><img src="{{ asset('images/111.png') }}" alt="Facebook"></a></li>
            <li><a href="#"><img src="{{ asset('images/instagram-logo-transparent-background-2.png') }}" alt="Instagram"></a></li>
            <li><a href="#"><img src="{{ asset('images/R.png') }}" alt="Twitter"></a></li>
            <li><a href="#"><img src="{{ asset('images/linkedIn_PNG8.png') }}" alt="LinkedIn"></a></li>
        </ul>
    </section>
</div>
@endsection
