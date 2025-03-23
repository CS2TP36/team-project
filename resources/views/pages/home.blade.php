@extends('layouts.page')
@section('title', 'Best SportsWear')
@use(App\Http\Controllers\FeaturedProductController)
@section('content')
    @section('script', 'js/featured-scroll.js')
    <div class="home"><!--creates the home class-->
        <section>
            <div id="banner-container"><!--creates the banner container-->
                <img src="{{asset('images/Banner.png')}}" id="banner">
                <div id="text-banner">
                    <p>Dream.</p>
                    <p>Aspire Higher.</p>
                    <p>Achieve Your Destiny.</p>
                    <!--<p>The Best Quality For The Best Price</p> -->
                </div>
            </div>
        </section>

        <div id=home-slogan><!--divide the sections-->
            <p> Unleash Your Potential. Embrace Greatness </p>
            <a href="/products">Shop Now</a>
        </div>

        <div id=catogery-divider><!--divide the sections-->
            <p> Browse Our Categories </p>
        </div>

        <div id="category-section"> <!--shows the sections for each catogery-->
            <ul>
                <li id="select-catogeries"><a href="/products/2/name/1/4"> <img
                            src="{{asset('images/jacket-pic.jpg')}}"> <h4>Jackets</h4></a></li><!--links to coats-->
                <li id="select-catogeries"><a href="/products/2/name/1/3"> <img
                            src="{{asset('images/hoodie-pic.jpg')}}"><h4> Hoodies</h4></a></h4></li>
                <li id="select-catogeries"><a href="/products/2/name/1/5"> <img src="{{asset('images/shirt-pic.jpg')}}">
                        <h4> Shirts</h4></a></li><!--links to shirts-->
                <li id="select-catogeries"><a href="/products/2/name/1/2"> <img
                            src="{{asset('images/trouser-pic.jpg')}}"> <h4>Joggers</h4></a></li><!--links joggers -->
                <li id="select-catogeries"><a href="/products/2/name/1/1"><img src="{{asset('images/shoe-pic.jpg')}}">
                        <h4>Trainers</h4></a></li><!--links to shoes -->

            </ul>
        </div>

        <div id="parallax-container">
            <div id="parallax" style="background-image: url({{ asset('images/Parallax.png') }});"></div>
            <div id=parallax-info>
                <h3>What Is SportsWear?</h3>
                <p> SportsWear is not just a clothing apparel. It's more than that, its about lifestyle, its about performance,
                    confidence, pushing past the limits to reach your dreams! We are a dedicated team, passionate about
                    providing high-quality SportsWear. Our mission is to support athletes and fitness
                    enthusiasts by offering products that combine style, performance and comfort.</p>
                <a href=/aboutus> Find out more! </a>
            </div>
        </div>

        <div id=catogery-divider>
            <p>Featured Products</p>
        </div>

        @php($featuredProducts = FeaturedProductController::getFeaturedProducts())

        <!-- TODO: rename this container and work out what ur doing with it -->
        <div class="featured-item-wrapper">
            <button class="back-button"><img src="{{asset('images/back_button.png')}}"></button>
            <div class="featured-item-container">
                @foreach($featuredProducts as $product)
                    <div class="featured-item">
                        <a href="{{ route('product.show', ['id' => $product->id]) }}" class="featured-link">
                            <img src="{{ asset($product->getMainImage()) }}" alt="{{ $product['name'] }}"
                                 class="featured-image">
                            <div class="featured-details">
                                <h3>{{ $product['name'] }}</h3>
                                <p>£{{ number_format($product['price'], 2) }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <button class="next-button"><img src="{{asset('images/next_button.png')}}"></button>
        </div>

    </div>


    <div id=catogery-divider>
        <p>What Can You Expect From Us?</p>
    </div>

    <div id=home-gurantee-container>
        <ul id=home-guarantee>
            <li id=guarantee-list><img src="{{asset('images/clothing-icon.png')}}">
                <h3> 100% High Quality Clothing</h3> All of our clothing is made from the finest fabrics, carefully tended to with excellent care.
                Every piece of apparel we craft is the result of our dedicated passion for providing our customers with the highest standard of sports fashion available.
            </li>
            <li id=guarantee-list><img src="{{asset('images/refund-icon.png')}}">
                <h3> Guaranteed Easy Free Returns </h3> Are you not happy with one of our pieces of clothing? No worries then! At Sportswear,
                we have an open and free refund policy, this means that if you are not happy with a product you purchased from us, you can always return it for a refund.

            </li>
            <li id=guarantee-list><img src="{{asset('images/delivery-truck.png')}}">
                <h3> Ultra Fast & Reliable Shipping</h3>We take pride in our ultra-fast shipping system, which we’ve put in place to ensure quick deliveries.
                Whenever you place an order, we guarantee delivery within four working days. Our delivery accuracy rating stands at 99%.
            </li>
        </ul>
    </div>

    <div id=catogery-divider>
        <p>Check Out Some Of Our Reviews</p>
    </div>

    <div id=home-review-container>
            <div id = home-reviews>
                <img src="{{asset('images/review-1.png')}}" id=home-review-pic>
                <h2> Johnathan Raybould</h2>
                <p id="star-0"><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span></p>
                <h1> Great Peformance </h1>
                <p>"I like to regularly go for my morning runs to start my day off. Therefore, I bought the Active Cool Compression Shirt.
                    I must say, the quality of the clothing has been absolutely fantastic. The performance is also top-notch, providing me with great posture while running."
                </p>
            </div>
            <div id = home-reviews>
                <img src="{{asset('images/review-2.png')}}" id=home-review-pic>
                <h2> Sally Cena</h2>
                <p id="star-0"><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span></p>
                <h1> Comfortable Trainers </h1>
                <p>"I need to buy new trainers that suit both my casual and sports lifestyle. I stumbled upon the SwiftRun Trainers, which feel very lightweight and comfortable, with fast and accurate delivery."
                </p>
            </div>
            <div id = home-reviews>
                <img src="{{asset('images/review-3.png')}}" id=home-review-pic>
                <h2> Jessica Cambell</h2>
                <p id="home-review-stars"><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span></p>
                <h1> Amazing Quality </h1>
                <p>"I bought the Luxe Fleece Hoodie and the Balance Crop Tee. The clothes were super comfortable and looked very high-quality when I wore them. I will definitely order from Sportswear again!"
                </p>
            </div>
    </div>



    </div>

@endsection


