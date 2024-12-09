@use(Illuminate\Support\Facades\Auth)
<footer class="footer-check"><!--creates the footer class container that holds all the items inside as well acts as the container-->
        <ul><!--list for contacting us-->
            <li class="footer-list"><a href="/contact">Contact Page</a></li><!--links to the contact page-->
            <li class="footer-list"><a href="https://maps.app.goo.gl/vJZFAyvd6BEAWSWdA">Address: Aston University</a></li><!--links to google maps-->
        </ul>

    <div>
        <ul><!--list for about us/terms-->
            <li class="footer-list"><a href="/aboutus">About Us</a></li><!--links to about us-->
            <li class="footer-list"><a href="/terms-conditions">Terms and condition</a></li><!--links to the terms and conditions-->
        </ul>
    </div>
    <div>
        <ul><!--list for signing in and toggle themee-->
            <li class="footer-list"> @if(!Auth::check()) <a href="/login">Sign in @else <a href="/logout"> Sign out @endif</a></li><!--sign in -->
            <li class="footer-list"><button id="theme-toggle">Toggle Theme</button></li><!--dark mode/light mode toggle theme-->
        </ul>
    </div>
</footer>
