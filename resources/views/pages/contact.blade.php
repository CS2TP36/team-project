@extends('layouts.page')
@section('title', 'Contact Us')
@section('script', 'js/contact.js')
@section('content')

<div class="contact-wrapper">
    <div class="contact-header">
        <h1>We'd ❤️ to help</h1>
        <p>We’re here to help! If you have any concerns, thoughts, problems or just want general information you have come to the right place</p>
    </div>

    <div class="contact-container">
        <div class="contact-details">
            <h2>Contact Info</h2>
            <ul>
                <li><strong>📍 Location:</strong> Birmingham, England</li>
                <li><strong>📧 Email:</strong> <a href="mailto:support@thesportswear.website">support@thesportswear.website</a></li>
                <li><strong>📞 Phone:</strong> 0121 898 919</li>
            </ul>
            <img src="{{ asset('images/logo-contact.png') }}" class = contact-us-brand> </img>
        </div>

        <div class="contact-form">
            <h2>Contact Form</h2>
            <form method="POST" action="/contact" onsubmit="validateContactForm(event)">
                @csrf

                <div class="input-box">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Your Name" required>
                </div>

                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="you@example.com" required>
                </div>

                <div class="input-box">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" placeholder="+44 1234 567890" required>
                </div>

                <div class="input-box">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" placeholder="Write your message here..." required></textarea>
                </div>

                <button type="submit" class="btn-send">Send Message</button>
            </form>
        </div>
    </div>

    <div class="social-section">
        <h2>Check us Out we also listen here! </h2>
        <div class="social-icons">
            <a href="https://www.facebook.com/"><img src="images/Facebook.png" alt="Facebook"></a>
            <a href="https://www.instagram.com/"><img src="images/Insta.png" alt="Instagram"></a>
            <a href="https://twitter.com/"><img src="images/x.png" alt="Twitter"></a>
            <a href="https://www.linkedin.com/"><img src="images/linkedIn.png" alt="LinkedIn"></a>
        </div>
    </div>
</div>

@endsection
