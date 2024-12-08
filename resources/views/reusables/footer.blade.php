@use(Illuminate\Support\Facades\Auth)
<footer class="footer-check">
        <ul>
            <li class="footer-list"><a href="/contact">Contact: 0121 010 0111</a></li>
            <li class="footer-list">Address: Aston University</li>
            <li class="footer-list">Open Hours: 6:00 - 23:00</li>
            <li class="footer-list">Follow Our Socials</li>
        </ul>

    <div>
        <ul>
            <li class="footer-list"><a href="/aboutus">About Us</a></li>
            <li class="footer-list">Privacy</li>
            <li class="footer-list"><a href="/terms-conditions">Terms and condition</a></li>
        </ul>
    </div>
    <div>
        <ul>
            <li class="footer-list">Page Directs</li>
            <li class="footer-list"> @if(!Auth::check()) <a href="/login">Sign in @else <a href="/logout"> Sign out @endif</a></li>
            <li class="footer-list">Orders and Payments</li>
            <li class="footer-list"><button id="theme-toggle">Toggle Theme</button></li>
        </ul>
    </div>
</footer>
