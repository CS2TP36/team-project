@extends('layouts.page')
@section('title','products')
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
<div >
    <ul class = catogery-selector>
        <li class= catogery> Clothes Catogery</li>
        <li class= catogery-buttons> Coats</li>
        <li class= catogery-buttons> Hoodies</li>
        <li class= catogery-buttons> Trousers</li>
        <li class= catogery-buttons> Shirts</li>
        <li class= catogery-buttons> Shoes</li>
    </ul>
    <ul class = catogery-selector>
        <li class= catogery> Gender </li>
        <li class= catogery-buttons> Mens</li>
        <li class= catogery-buttons> Women</li>
    </ul>
    <ul class = catogery-selector>
        <li class= catogery> Size</li>
        <li class= catogery-buttons> 5</li>
        <li class= catogery-buttons> 6</li>
        <li class= catogery-buttons> 7</li>
        <li class= catogery-buttons> 8</li>
        <li class= catogery-buttons> 9</li>
        <li class= catogery-buttons> 10</li>
        <li class= catogery-buttons> 11</li>
        <li class= catogery-buttons> 12</li>
        <li class= catogery-buttons> 13</li>
        <li class= catogery-buttons> 14</li>
    </ul>
    <ul class = catogery-selector>
        <li class= catogery> Price</li>
        <li class= catogery-buttons> £0 to £50</li>
        <li class= catogery-buttons>  £50 to £100</li>
        <li class= catogery-buttons>  £100 to £150</li>
        <li class= catogery-buttons>  £150 to £250</li>
    </ul>
    <ul class = catogery-selector>
        <li class= catogery> On Sale</li>
        <li class= catogery-buttons> Discounted Items </li>
    </ul>
</div>
@endsection
