@extends('layouts.page')
@section('title','products')
@use('\App\Http\Controllers\ProductLister')
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
<div class = "Filter-Page">
    <ul class="category-selector">
        <li class="category">Sort By</li>
        <li class="category-buttons">
            <input type="radio" id="popular" name="sort-by">
            <label for="popular">Most Popular</label>
        </li>
        <li class="category-buttons">
            <input type="radio" id="low-to-high" name="sort-by">
            <label for="low-to-high">Price (Low To High)</label>
        </li>
    </ul>

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

    <ul class="category-selector">
        <li class="category">Gender</li>
        <li class="category-buttons">
            <input type="radio" id="mens" name="gender">
            <label for="mens">Mens</label>
        </li>
        <li class="category-buttons">
            <input type="radio" id="women" name="gender">
            <label for="women">Women</label>
        </li>
    </ul>


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

    <ul class="category-selector">
        <li class="category">Price</li>
        <li class="category-buttons">
            <input type="radio" id="price-0-50" name="price">
            <label for="price-0-50">£0 to £50</label>
        </li>
        <li class="category-buttons">
            <input type="radio" id="price-50-100" name="price">
            <label for="price-50-100">£50 to £100</label>
        </li>
        <li class="category-buttons">
            <input type="radio" id="price-100-150" name="price">
            <label for="price-100-150">£100 to £150</label>
        </li>
        <li class="category-buttons">
            <input type="radio" id="price-150-250" name="price">
            <label for="price-150-250">£150 to £250</label>
        </li>
    </ul>

    <ul class="category-selector">
        <li class="category">On Sale</li>
        <li class="category-buttons">
            <input type="radio" id="discounted-items" name="sale">
            <label for="discounted-items">Discounted Items</label>
        </li>
    </ul>

    <ul class="category-selector">
        <li><button class="filter-btn">Apply Filter</button></li>
    </ul>
</div>

@php($products = ProductLister::get())
<div id="products-list">
    @foreach($products as $product)
        <div class="product-item">
            <h3>{{ $product['name'] }}</h3>
            <p>£{{ $product['price'] }}</p>
            <!-- images might work now with $product->getMainImage() -->
        </div>
    @endforeach
</div>

@endsection

