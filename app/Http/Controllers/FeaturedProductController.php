<?php

namespace App\Http\Controllers;

use App\Models\Product;

class FeaturedProductController extends Controller
{
    // function which returns a list of 12 featured products
    static function getFeaturedProducts(): \Illuminate\Database\Eloquent\Collection {
        // returns a random selection of 12 products
        return Product::all()->random(12);
        //TODO: in future could use different logic for selecting featured products
        //TODO: if never think of something delete ↑
    }
}
