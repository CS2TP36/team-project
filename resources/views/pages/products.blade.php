@extends('layouts.page')
@section('title','products')
@use('App\Http\Controllers\ProductLister')
@section('content')
    <section>
        <div id="banner-container">
            <img src="{{asset('images/products-banner.png')}}" id="banner">
            <div id="text-banner">
                <p>Our Products</p>
                <p>The finest selection of clothings, produced for the finest of people</p>
            </div>
        </div>
    </section>

    <div id=catogery-divider>
        <p>Products</p>
    </div>
    <!--
         Look at \App\Http\Controllers\ProductLister::get
         Should return a list of products and do all the sorting for you
         if you give it the right parameters.
    -->
    <form method="GET" action="">
        <div class=Products-Filter-Container>
            <div class="Filter-Page">
                <ul class="category-selector">
                    <li class="category">Sort By</li>
                    <ul class="category-selector">
                        <li class="category">Sort By</li>
                        <li class="category-buttons">
                            <input type="radio" id="low-to-high" name="sort-by" value="low-to-high">
                            <label for="low-to-high">Price (Low To High)</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="high-to-low" name="sort-by" value="high-to-low">
                            <label for="high-to-low">Price (High To Low)</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="alphabetical-a-to-z" name="sort-by" value="a-to-z">
                            <label for="alphabetical-a-to-z">Alphabet (A-Z)</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="alphabetical-z-to-a" name="sort-by" value="z-to-a">
                            <label for="alphabetical-z-to-a">Alphabet (Z-A)</label>
                        </li>
                    </ul>


                    <div class="line-break"></div>

                    <ul class="category-selector">
                        <li class="category">Clothes Category</li>
                        <li class="category-buttons">
                            <input type="radio" id="coats" name="clothes-category">
                            <label for="coats">Coats</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="hoodies" name="clothes-category">
                            <label for="hoodies">Hoodies</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="trousers" name="clothes-category">
                            <label for="trousers">Trousers</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="shirts" name="clothes-category">
                            <label for="shirts">Shirts</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="shoes" name="clothes-category">
                            <label for="shoes">Shoes</label>
                        </li>
                    </ul>

                    <div class="line-break"></div>

                    <ul class="category-selector">
                        <li class="category">Gender</li>
                        <li class="category-buttons">
                            <input type="radio" id="mens" name="gender">
                            <label for="mens">Mens</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="womens" name="gender">
                            <label for="women">Women</label>
                        </li>
                    </ul>

                    <div class="line-break"></div>

                    <ul class="category-selector">
                        <li class="category">Size</li>
                        <li class="category-buttons">
                            <input type="radio" id="size-5" name="size">
                            <label for="size-5">5</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="size-6" name="size">
                            <label for="size-6">6</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="size-7" name="size">
                            <label for="size-7">7</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="size-8" name="size">
                            <label for="size-8">8</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="size-9" name="size">
                            <label for="size-9">9</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="size-10" name="size">
                            <label for="size-10">10</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="size-11" name="size">
                            <label for="size-11">11</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="size-12" name="size">
                            <label for="size-12">12</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="size-13" name="size">
                            <label for="size-13">13</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="size-14" name="size">
                            <label for="size-14">14</label>
                        </li>
                    </ul>

                    <div class="line-break"></div>

                    <ul class="category-selector">
                        <li class="category">Price</li>
                        <li class="category-buttons">
                            <input type="radio" id="price-0-25" name="price">
                            <label for="price-0-25">£0 to £25</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="price-25-35" name="price">
                            <label for="price-25-35">£25 to £35</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="price-35-45" name="price">
                            <label for="price-35-45">£35 to £45</label>
                        </li>
                        <li class="category-buttons">
                            <input type="radio" id="price-45+" name="price">
                            <label for="price-45+">£45+</label>
                        </li>
                    </ul>

                    <div class="line-break"></div>

                    <ul class="category-selector">
                        <li class="category">On Sale</li>
                        <li class="category-buttons">
                            <input type="radio" id="discounted-items" name="sale">
                            <label for="discounted-items">Discounted Items</label>
                        </li>
                    </ul>

                    <ul class="category-selector">
                        <li>
                            <button class="filter-btn" onclick="applyFilters()">Apply Filter</button>
                        </li>
                    </ul>
            </div>
    </form>

    <div id="products-list">
        @foreach($products as $product)
            <div class="product-item">
                <a href="{{ route('product.show', ['id' => $product->id]) }}" class="product-link">
                    <img src="{{ asset($product->getMainImage()) }}" alt="{{ $product['name'] }}" class="product-image"
                         style="width: 300px; height: 300px;">
                    <div class="product-details">
                        <h3>{{ $product['name'] }}</h3>
                        <p>£{{ $product['price'] }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    </div>
    </form>
    <script>

        function applyFilters() {
            // get the elements for price sorting
            let priceHigh = document.getElementById('high-to-low');
            let priceLow = document.getElementById('low-to-high');
            // sorts by name as defualt
            let sortField = "name";

            // deals with the  gender selector
            const gender = document.querySelector('input[name="gender"]:checked');
            let genderVal = 2;
            if (gender) {
                genderVal = (gender.id === "mens" ? 1 : (gender.id === "womens" ? "0" : 2));
            }

            // deals with sorting
            const sortBy = document.querySelector('input[name="sort-by"]:checked');
            let filtDirection = "0";
            if (sortBy) {
                // check if they are sorting by price or name
                if (priceHigh.checked || priceLow.checked) {
                    // changes to price if sorting by price
                    sortField = "price";
                    // sets direction for sorting
                    filtDirection = (sortBy.id === 'high-to-low' ? "0" : 1);
                } else {
                    // sets direction for sorting
                    filtDirection = (sortBy.id === 'alphabetical-a-to-z' ? 1 : "0");
                }

            }

            // sets the correct category
            let clothesCategoryValue = "0";
            const clothesCategory = document.querySelector('input[name="clothes-category"]:checked');
            if (clothesCategory) {
                switch (clothesCategory.id) {
                    case 'coats':
                        clothesCategoryValue = 4;
                        break;
                    case 'hoodies':
                        clothesCategoryValue = 3;
                        break;
                    case 'trousers':
                        clothesCategoryValue = 2;
                        break;
                    case 'shirts':
                        clothesCategoryValue = 5;
                        break;
                    case 'shoes':
                        clothesCategoryValue = 1;
                        break;
                }
            }

            // deals with the price filter selectors
            let priceFilter = "0";
            const priceFilters = document.querySelector('input[name="price"]:checked');
            if (priceFilters) {
                switch (priceFilters.id) {
                    case 'price-0-25':
                        priceFilter = 1;
                        break;
                    case 'price-25-35':
                        priceFilter = 2;
                        break;
                    case 'price-35-45':
                        priceFilter = 3;
                        break;
                    case 'price-45+':
                        priceFilter = 4;
                        break;
                }
            }



            // generate the url
            const url = `/products/${genderVal || ''}/${sortField || ''}/${filtDirection || ''}/${clothesCategoryValue || ''}/${priceFilter}`;
            window.open(url);
        }
    </script>

@endsection

