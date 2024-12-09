@use(Illuminate\Support\Facades\Auth)
<footer class="footer-check">
        <ul>
            <li class="footer-list"><a href="/contact">Contact Page</a></li>
            <li class="footer-list"><a href="https://maps.app.goo.gl/vJZFAyvd6BEAWSWdA">Address: Aston University</a></li>
        </ul>

    <div>
        <ul>
            <li class="footer-list"><a href="/aboutus">About Us</a></li>
            <li class="footer-list"><a href="/terms-conditions">Terms and condition</a></li>
        </ul>
    </div>
    <div>
        <ul>
            <li class="footer-list"> @if(!Auth::check()) <a href="/login">Sign in @else <a href="/logout"> Sign out @endif</a></li>
            <li class="footer-list"><button id="theme-toggle">Toggle Theme</button></li>
        </ul>
    </div>
</footer>
