<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// manages the review system
class ReviewController extends Controller
{
    // function to show the add review page
    function show($productId) {
        // get the product
        $product = Product::all()->where('id', $productId)->first();
        // TODO: find out if they have bought the product
        $purchased = true;
        // return page if purchased and product exists
        if ($purchased && $product) {
            return view('pages.review', ['product' => $product]);
        } else {
            return redirect()->back()->with('error', 'You must purchase the product to review it');
        }
    }
    function add(Request $request) {
        // validate request
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'message' => 'required|string',
            'product_id' => 'required|integer',
            'headline' => 'required|string',
        ]);
        // check if logged in
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to review a product');
        }
        $user = Auth::user();
        // create review
        $review = new Review([
            'user_id' => $user['id'],
            'product_id' => $request['product_id'],
            'rating' => $request['rating'],
            'review' => $request['message'],
            'title' => $request['headline']
        ]);
        // save it
        $review->save();
        // return to product page with message
        return redirect()->route('product.show', ['id' => $request['product_id']])->with('message', 'Review added successfully');
    }
}
