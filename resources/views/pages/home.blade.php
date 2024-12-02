@extends('layouts.page')
@section('title')
    Best SportsWear
@endsection


@section('content')
<div class= "home">
    <section>
        <div id="banner-container">
            <img src="{{asset('images/Hero-banner.jpeg')}}" id="banner">
            <div id="text-banner">
                <p>The Best Quality For The Best Price</p>
                <a href="/products">Shop Now</a>
            </div>
        </div>
    </section>

    <div id=catogery-divider>
        <p>Categories</p>
    </div>

    <div id="category-section">
        <ul>
            <li id="select-catogeries"><img src="{{asset('images/coat.jpg')}}"> <a href="/products/2/name/1/4">Jackets</a></li>
            <li id="select-catogeries"><img src="{{asset('images/hoodies.jpg')}}"> <a href="/products/2/name/1/3">Hoodies</a></li>
            <li id="select-catogeries"><img src="{{asset('images/Joggers.jpg')}}"> <a href="/products/2/name/1/2">Joggers</a></li>
            <li id="select-catogeries"><img src="{{asset('images/shoes.jpg')}}"> <a href="/products/2/name/1/1">Trainers</a></li>
            <li id="select-catogeries"><img src="{{asset('images/shirt.jpg')}}"> <a href="/products/2/name/1/5">Shirts</a></li>
        </ul>
    </div>

    <div id=catogery-divider>
        <p>Gender</p>
    </div>

    <div id="gender-section">
        <ul>
            <li id="select-catogeries"><img src="{{asset('images/Man.jpg')}}"> <a href="/products/1">Men</a></li>
            <li id="select-catogeries"><img src="{{asset('images/Woman.jpg')}}"> <a href="/products/0">Women</a></li>
        </ul>
    </div>
</div>
@endsection
