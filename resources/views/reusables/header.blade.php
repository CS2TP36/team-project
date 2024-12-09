<header> 
    <nav class="navbar"> <!--Creates the navbar class creating a container-->
        <div class="navbardiv"><!--Is the div which will contain all the items that are present on the logo-->
            <a href="/home"><img src="{{ asset('images/Logo.JPG') }}" class="logo" alt="logo"></a>
            <input id="search-bar" type="search" placeholder="Search Here" onsearch="search()"> </input><!--search bar gets created-->
            <ul>
                <li class=prime-list><!--class holds the account and basket links-->
                    <a href="/account">Account</a><!--links to account page-->
                    <a href="/basket">Basket</a><!--links to basket page-->
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
</header>
