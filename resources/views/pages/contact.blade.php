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
                            <strong>Email:</strong> <a href="mailto:sportwear@gmail.com">Sportwear@gmail.com</a><br>
                            <strong>Phone:</strong> 0121 898 919
                        </li>
                    </ul>
                </div>

                <h1 class = "contact-header">Contact Me</h1>

                <form action="none" onsubmit="validateContactForm(event)">

                    <label for="name">Full Name</label><br>
                    <input type="text" name="name" id="name" placeholder="Full Name" required><br>

                    <label for="email">Your Email</label><br>
                    <input type="email" name="email" id="email" placeholder="include@" required><br>

                    <label for="subject">Contact Number</label><br>
                    <input type="text" name="subject" id="subject" placeholder="+44" required><br>

                    <label for="country">Country</label>
                    <select name="country" id="country">
                        <option value="US">United States</option>
                        <option value="GB">Great Britain</option>
                        <option value="EURO">Europe</option>
                    </select>
                    <br>

                    <label for="message">Message</label><br>
                    <textarea name="message" id="message" cols="10" rows="7" placeholder="Start Typing Here" required></textarea><br>

                    <input type="submit" value="Submit">
                    <input type="reset" value="Erase All">
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
                <label for="rating">Please Rate our Service</label><br>
                <input type="range" id="rating" name="rating" min="1" max="10" step="1">
            </div>
        </div>
    </div>
@endsection
