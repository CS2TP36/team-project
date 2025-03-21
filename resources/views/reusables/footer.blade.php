@use(Illuminate\Support\Facades\Auth)
<footer class="footer-container"><!--creates the footer class container that holds all the items inside as well acts as the container-->
        <ul><!--list for contacting us-->
            <li class="footer-title">Customer Service</li><!--links to the contact page-->
            <li class="footer-list"><a href="/contact">Contact Us</a></li><!--links to the contact page-->
            <li class="footer-list"><a href="/delivery-and-returns">Delivery and Returns</a></li><!--links to about us-->
            <li class="footer-list"><a href="/faq">FAQ</a></li>
            <li class="footer-list"><a href="/careers">Careers</a></li>
        </ul>

    <div>
        <ul><!--list for about us/terms-->
            <li class="footer-title">Company Info</li>
            <li class="footer-list"><a href="/aboutus">About Us</a></li>
            <li class="footer-list"><a href="/terms-conditions">Terms & Conditions</a></li><!--links to the terms and conditions-->
            <li class="footer-list"><a href = "/sponsor">Sponsorship</a></li>
            <li class="footer-list"><a href = "/sustainability">Sustainability</a></li>
            <li class="footer-list"><a href="{{ route('privacy') }}">Privacy Policy</a></li>
        </ul>
    </div>

    <div>
        <ul><!--list for signing in and toggle theme-->
            <li class="footer-title">Account Info</li>
            <li class="footer-list"> @if(!Auth::check()) <a href="/login">Sign In @else <a href="/logout"> Sign Out @endif</a></li><!--sign in -->
            <li class="footer-list"><a href="/wishlist">Wishlist</a></li>
        </ul>
    </div>
    <div>
        <ul><!--list for signing in and toggle theme-->
            <li class="footer-title">Follow Us</li>
            <li class="footer-list"> <a href="https://www.facebook.com/"> <img src="{{asset('images/Facebook.png')}}" id = social-pic></li>
            <li class="footer-list"> <a href="https://x.com/"> <img src="{{asset('images/x.png')}}" id = social-pic></li>
            <li class="footer-list"> <a href="https://www.instagram.com/"> <img src="{{asset('images/Insta.png')}}" id = social-pic></li>
        </ul>
    </div>

</footer>
