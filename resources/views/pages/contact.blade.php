@extends('layouts.page')
@section('title','Contact Us')
@section('script','js/contact.js')
@section('content')
    <div class="contact">
        <div class="banner">
            <h1>Contact Us - We're here to help!</h1>
        </div>

        <div class="container">
            <div class="contactInfo">
                <div>
                    <h2>Contact Info</h2>
                    <ul class="info">
                        <li>
                            <strong>Address:</strong> 90 Aston Street<br>
                            <strong>Post Code:</strong> B9 020 <br>
                            <strong>Email:</strong> <a href="mailto:support@thesportswear.website">support@thesportswear.website</a><br>
                            <strong>Phone:</strong> 0121 898 919
                        </li>
                    </ul>
                </div>

                <h1 class = "contact-header">Contact Us</h1>

                <form method="POST" action="/contact" onsubmit="validateContactForm(event)">
                    @csrf

                    <label for="name">Full Name</label><br>
                    <input type="text" name="name" id="name" placeholder="Full Name" required><br>

                    <label for="email">Your Email</label><br>
                    <input type="email" name="email" id="email" placeholder="include@" required><br>

                    <label for="phone">Contact Number</label><br>
                    <input type="text" name="phone" id="phone" placeholder="+44" required><br>

                    <label for="message">Message</label><br>
                    <textarea name="message" id="message" cols="10" rows="7" placeholder="Start Typing Here" required style="resize: none"></textarea><br>

                    <input type="reset" value="Erase All">
                    <input type="submit" value="Submit">
                </form>
            </div>

            <div class="social-links">
                <h2>Follow Us</h2>
                <ul>
                    <li><a href="https://www.facebook.com/"><img src="images/111.png" alt="Facebook"></a></li>
                    <li><a href="https://www.instagram.com/"><img src="images/instagram-logo-transparent-background-2.png" alt="Instagram"></a></li>
                    <li><a href="https://twitter.com/"><img src="images/R.png" alt="Twitter"></a></li>
                    <li><a href="https://www.linkedin.com/"><img src="images/linkedIn_PNG8.png" alt="LinkedIn"></a></li>
                </ul>

        </div>
    </div>
@endsection
