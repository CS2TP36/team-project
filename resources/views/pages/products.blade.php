@extends('layouts.page')
@section('title','Products')
@use('App\Http\Controllers\ProductLister')
@section('script', asset("js/products-filter.js"))
@section('content')
    <section><!--creates a banner container to contain our banner-->
        <div id="banner-container"><!--creates ID for our banner-->
            <img src="{{asset('images/product-banner.png')}}" id="banner"><!--links to our banner-->
            <div id="product-text-banner"><!--id for banner-->
                <p>Check Out Our Products</p>
            </div>
        </div>
    </section>

    <div id=catogery-divider><!--Used to divide sections-->
        <p>Browse Our Products</p>
    </div>

    <!-- a breadcrumb menu -->
    <div id="breadcrumbs">
        <p id="breadcrumb-list"><a href="/products">Products > </a></p>
    </div>

    <!--
         Look at \App\Http\Controllers\ProductLister::get
         Should return a list of products and do all the sorting for you
         if you give it the right parameters.
    -->
    <form method="GET" action="" id="productFilterForm"><!--the form of filtering though clothes-->
        <div class=Products-Filter-Container><!--creates the container for both products and filters-->
            <div class="Filter-Page"><!--creates filter page container -->
                <ul class="category-selector"><!--creates a class to select categories-->
                    <ul class="category-selector">
                        <li class="category">Sort By</li><!--select catogery to filter by-->
                        <li class="category-buttons">
                            <input type="radio" id="popularity" name="sort-by" value="popularity">
                            <label for="popularity">Popularity</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="low-to-high" name="sort-by" value="low-to-high">
                            <label for="low-to-high">Price (Low To High)</label>
                        </li>
                        <li class="category-buttons"><!--creates the buttons to click on the filter for each one-->
                            <input type="radio" id="high-to-low" name="sort-by" value="high-to-low">
                            <label for="high-to-low">Price (High To Low)</label>
                        </li>
                        <li class="category-buttons"><!--creates the buttons to click on the filter for each one-->
                            <input type="radio" id="alphabetical-a-to-z" name="sort-by" value="a-to-z" checked="checked">
                            <label for="alphabetical-a-to-z">Alphabet (A-Z)</label>
                        </li>
                        <li class="category-buttons"><!--creates the buttons to click on the filter for each one-->
                            <input type="radio" id="alphabetical-z-to-a" name="sort-by" value="z-to-a">
                            <label for="alphabetical-z-to-a">Alphabet (Z-A)</label>
                        </li>
                    </ul>

                    <div class="line-break"></div><!--line break to act as a break between each filter sections-->

                    <ul class="category-selector">  <!--creates the buttons to click on the filter for each one-->
                        <li class="category">Clothes Category</li>
                        <li class="category-buttons">
                            <input type="radio" id="coats" name="clothes-category">
                            <label for="coats">Coats</label>
                        </li>
                        <li class="category-buttons"><!--creates the buttons to click on the filter for each one-->
                            <input type="radio" id="hoodies" name="clothes-category">
                            <label for="hoodies">Hoodies</label>
                        </li>
                        <li class="category-buttons"><!--creates the buttons to click on the filter for each one-->
                            <input type="radio" id="trousers" name="clothes-category">
                            <label for="trousers">Trousers</label>
                        </li>
                        <li class="category-buttons"><!--creates the buttons to click on the filter for each one-->
                            <input type="radio" id="shirts" name="clothes-category">
                            <label for="shirts">Shirts</label>
                        </li>
                        <li class="category-buttons"><!--creates the buttons to click on the filter for each one-->
                            <input type="radio" id="shoes" name="clothes-category">
                            <label for="shoes">Shoes</label>
                        </li>
                    </ul>

                    <div class="line-break"></div><!--line break to act as a break between each filter sections-->

                    <ul class="category-selector"><!--creates the buttons to click on the filter for each one-->
                        <li class="category">Gender</li>
                        <li class="category-buttons">
                            <input type="radio" id="mens" name="gender">
                            <label for="mens">Mens</label>
                        </li>
                        <li class="category-buttons"><!--creates the buttons to click on the filter for each one-->
                            <input type="radio" id="womens" name="gender">
                            <label for="women">Women</label>
                        </li>
                    </ul>

                    <div class="line-break"></div><!--line break to act as a break between each filter sections-->

                    <ul class="category-selector"><!--creates the buttons to click on the filter for each one-->
                        <li class="category">Price</li>
                        <li class="category-buttons">
                            <input type="radio" id="price-0-25" name="price">
                            <label for="price-0-25">£0 to £25</label>
                        </li>
                        <li class="category-buttons"><!--creates the buttons to click on the filter for each one-->
                            <input type="radio" id="price-25-35" name="price">
                            <label for="price-25-35">£25 to £35</label>
                        </li>
                        <li class="category-buttons"><!--creates the buttons to click on the filter for each one-->
                            <input type="radio" id="price-35-45" name="price">
                            <label for="price-35-45">£35 to £45</label>
                        </li>
                        <li class="category-buttons"><!--creates the buttons to click on the filter for each one-->
                            <input type="radio" id="price-45+" name="price">
                            <label for="price-45+">£45+</label>
                        </li>
                    </ul>

                    <ul class="category-selector"><!--The apply button filters-->
                        <li>
                            <button class="filter-btn" onclick="applyFilters()">Apply Filter</button>
                            <!--The apply button filters then proceeds to use js function-->
                        </li>
                    </ul>
            </div>
    </form>

    <div id="products-list"><!--products list id-->
        @if(isset($message))
            <!--checks if a message has been set and if it has then it displays it-->
            <div id="message">
                <p>{{$message}}</p><!--displays the message-->
            </div
        @endif
        @foreach($products as $product)
            <div class="product-item">
                <!--for each of the products in the products catogery it iterates through it and  present it in the webpage-->
                <a href="{{ route('product.show', ['id' => $product->id]) }}" class="product-link">
                    <!--gets the product id and the link to the product details page-->
                    <img src="{{ asset($product->getMainImage()) }}" alt="{{ $product['name'] }}"
                         class="product-image"></img><!--get the image for each of the products-->
                    <div class="product-details"><!--creates the  product details class -->
                        <h3>{{ $product['name'] }}</h3><!--Tprints the products name-->
                        <p>£{{ number_format($product['price'],2) }}</p><!--prints the price-->
                    </div>
                </a>
            </div>
        @endforeach <!--ends the iteration loop-->
    </div>
    </div>
    </form>
@endsection

