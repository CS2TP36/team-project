<?php

namespace App\Http\Controllers;

use App\Models\Product;

class FeaturedProductController extends Controller
{
    // function which returns a list of 8 featured products
    static function getFeaturedProducts(): \Illuminate\Database\Eloquent\Collection {
        // returns a random selection of 8 products
        return Product::all()->random(8);
    }
}
