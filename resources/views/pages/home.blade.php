@extends('layouts.page')
    @section('title')
    Best SportsWear
    @endsection


@section('content')
<nav class = "second-nav">
    <div class ="second-navdiv">
        <ul>
            <li class = subprime-list><a href="#"></a>Men</li>
            <li class = subprime-list><a href="#"></a>Women</li>
        </ul>
    </div>
</nav>

<section>
    <div id="banner-container">
        <img src="{{asset('images/Hero-banner.jpeg')}}" id="banner">
        <div id="text-banner">
            <p>The Best Quality For The Best Price</p>
            <a href="#">Shop Now</a>
        </div>
    </div>
</section>

<div id = catogery-divider>
<p>Catogeries</p>
</div>

<div id="category-section">
    <ul>
        <li id="select-catogeries"> <img src = "{{asset('images/coat.jpg')}}"> <a href="#">Coats</a></li>
        <li id="select-catogeries"> <img src = "{{asset('images/Joggers.jpg')}}"> <a href="#">Joggers</a></li>
        <li id="select-catogeries"> <img src = "{{asset('images/shoes.jpg')}}"> <a href="#">Trainers</a> </li>
        <li id="select-catogeries"> <img src = "{{asset('images/shirt.jpg')}}"> <a href="#">Shirts</a></li>
    </ul>
</div>

<div id = catogery-divider>
    <p>Gender</p>
    </div>

    <div id="gender-section">
        <ul>
            <li id="select-catogeries"> <img src = "{{asset('images/Man.jpg')}}"> <a href="#">Men</a></li>
            <li id="select-catogeries"> <img src = "{{asset('images/Woman.jpg')}}"> <a href="#">Women</a></li>
        </ul>
    </div>
@endsection
