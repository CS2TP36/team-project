<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

// manages the review system
class ReviewController extends Controller
{
    // function to show the add review page
    function show($productId) {
        // get the product
        $product = Product::all()->where('id', $productId)->first();
        // TODO: find out if they have bought the product
        $purchased = true;
        // return page if purchased
        if ($purchased && $product) {
            return view('pages.review', ['product' => $product]);
        } else {
            return redirect()->back()->with('error', 'You must purchase the product to review it');
        }
    }
    function add(Request $request) {

    }
}
