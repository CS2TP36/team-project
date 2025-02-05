@extends('layouts.page')
@section('title', 'Best SportsWear')
@section('content')
<div class= "home"><!--creates the home class-->
    <section>
        <div id="banner-container"><!--creates the banner container-->
            <img src="{{asset('images/Banner.png')}}" id="banner">
            <div id="text-banner">
            <p>Dream</p>
            <p>Aspire Higher</p>
            <p>Achieve Your Destiny</p>
                <!--<p>The Best Quality For The Best Price</p> -->
                <!--<a href="/products">Shop Now</a>-->
            </div>
        </div>
    </section>

    <div id=catogery-divider><!--divide the sections-->
        <p>Browse Our Categories</p>
    </div>

    <div id="category-section"> <!--shows the sections for each catogery-->
        <ul>
            <li id="select-catogeries"><img src="{{asset('images/coat.jpg')}}"> <a href="/products/2/name/1/4">Jackets</a></li><!--links to coats-->
            <li id="select-catogeries"><img src="{{asset('images/hoodies.jpg')}}"> <a href="/products/2/name/1/3">Hoodies</a></li><!--links to hoodies-->
            <li id="select-catogeries"><img src="{{asset('images/Joggers.jpg')}}"> <a href="/products/2/name/1/2">Joggers</a></li><!--links joggers -->
            <li id="select-catogeries"><img src="{{asset('images/shoes.jpg')}}"> <a href="/products/2/name/1/1">Trainers</a></li><!--links to shoes -->
            <li id="select-catogeries"><img src="{{asset('images/shirt.jpg')}}"> <a href="/products/2/name/1/5">Shirts</a></li><!--links to shirts-->
        </ul>
    </div>

    <div id=catogery-divider>
        <p>Gender</p>
    </div>

    <div id="gender-section"><!--shows the section for genders-->
        <ul>
            <li id="select-catogeries"><img src="{{asset('images/Man.jpg')}}"> <a href="/products/1">Men</a></li><!--links for men-->
            <li id="select-catogeries"><img src="{{asset('images/Woman.jpg')}}"> <a href="/products/0">Women</a></li><!--links for women-->
        </ul>
    </div>
</div>
@endsection<!--ends section layout-->
