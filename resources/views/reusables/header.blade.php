@section('script', 'js/featured-scroll.js')
<header>
    <nav class="navbar"> <!--Creates the navbar class creating a container-->
        <div class="navbardiv"><!--Is the div which will contain all the items that are present on the logo-->
            <a href="/home"><img src="{{ asset('images/Brand.png') }}" class="logo" alt="logo"><img src="{{ asset('images/logo-m.png') }}" class="logo-m" hidden></a>
            <ul>
                <li class=prime-list><!--class holds the account and basket links-->
                    <form class="searchbar-container" onsubmit="event.preventDefault(); search();">
                        <input id="search-bar" type="search" placeholder="Search SportsWear">
                            <img src="{{ asset('images/search.PNG') }}" class="search-logo" alt="Search Icon">
                    </form>
                    <a id="theme-toggle"><img src="{{ asset('images/light-mode-icon.png') }}" class="user-logo" ></img><img src="{{ asset('images/dark-mode-icon.png') }}" class="user-logo" ></img></a>
                    <a href="/account"><img src="{{ asset('images/Account.png') }}" class="user-logo" ></a> <!--links to account page-->
                    <a href="/wishlist"><img src="{{ asset('images/Hearts.png') }}" class="user-logo" > </a>
                    <a href="/basket"><img src="{{ asset('images/Shop.png') }}" class="user-logo" > </a> <!--links to basket page-->
                </li>
            </ul>
        </div>
    </nav>
    <nav class="second-nav"><!--creates a secondary navigation-->
        <div class="second-navdiv"><!--creates the second nav div which will hold all the items together-->
            <ul>
                <li class=subprime-list><a href="/products/1">Men</a></li><!--holds all of the gender links-->
                <li class=subprime-list><a href="/products/0">Women</a></li><!--links to men and women-->
            </ul>
        </div>
    </nav>
    <!-- kind of want a messages/error section here -->
    <div class="message-area">
        @if(session('message'))
            <div class="message">{{ session('message') }}</div>
        @endif
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
    </div>
</header>

