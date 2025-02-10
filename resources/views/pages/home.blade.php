@extends('layouts.page')
@section('title', 'Best SportsWear')
@use(App\Http\Controllers\FeaturedProductController)
@section('content')
@section('script', 'js/featured-scroll.js')
<div class= "home"><!--creates the home class-->
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
        <p>  Unleash Your Potential. Embrace Greatness </p>
        <a href="/products">Shop Now</a>
    </div>

    <div id=catogery-divider><!--divide the sections-->
        <p>  Browse Our Categories  </p>
    </div>

    <div id="category-section"> <!--shows the sections for each catogery-->
        <ul>
            <li id="select-catogeries"> <a href="/products/2/name/1/4"> <img src="{{asset('images/jacket-pic.jpg')}}"> Jackets</a></li><!--links to coats-->
            <li id="select-catogeries"> <a href="/products/2/name/1/3"> <img src="{{asset('images/hoodie-pic.jpg')}}"> Hoodies</a></li><!--links to hoodies-->
            <li id="select-catogeries"> <a href="/products/2/name/1/2"> <img src="{{asset('images/trouser-pic.jpg')}}"> Joggers</a></li><!--links joggers -->
            <li id="select-catogeries"> <a href="/products/2/name/1/1"><img src="{{asset('images/shoe-pic.jpg')}}"> Trainers</a></li><!--links to shoes -->
            <li id="select-catogeries"> <a href="/products/2/name/1/5"> <img src="{{asset('images/shirt-pic.jpg')}}"> Shirts</a></li><!--links to shirts-->
        </ul>
    </div>



    <div id=catogery-divider>
        <p>Featured Products</p>
    </div>

    @php($featuredProducts = FeaturedProductController::getFeaturedProducts())

        <!-- TODO: rename this container and work out what ur doing with it -->
        <div class = "featured-item-wrapper">    
            <button class="back-button"> <img src="{{asset('images/back_button.png')}}"></button>
            <div class="featured-item-container">
                    @foreach($featuredProducts as $product)
                        <div class="featured-item">
                            <a href="{{ route('product.show', ['id' => $product->id]) }}" class="featured-link">
                                <img src="{{ asset($product->getMainImage()) }}" alt="{{ $product['name'] }}" class="featured-image">
                                <div class="featured-details">
                                    <h3>{{ $product['name'] }}</h3>
                                    <p>£{{ number_format($product['price'], 2) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            <button class="next-button"> <img src="{{asset('images/next_button.png')}}"></button>
            </div>
            
        </div>


    

    <!-- <div id="gender-section">
        <ul>
            <li id="select-catogeries"><img src="{{asset('images/Man.jpg')}}"> <a href="/products/1">Men</a></li>
            <li id="select-catogeries"><img src="{{asset('images/Woman.jpg')}}"> <a href="/products/0">Women</a></li>
        </ul>
    </div>-->

     <!--<div id="parallax-container">
        <div id="parallax" style="background-image: url('{{ asset('images/area.png') }}');"></div>
    </div>-->
</div>


@endsection


