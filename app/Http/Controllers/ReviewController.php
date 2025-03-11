<?php

namespace App\Http\Controllers;

use App\Models\IndividualOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// manages the review system
class ReviewController extends Controller
{
    // function to show the add review page
    function show($productId) {
        // get the product
        $product = Product::all()->where('id', $productId)->first();
        // check if logged in
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to review a product');
        }
        // check if user has purchased the product
        $userid = Auth::user()['id'];
        $purchased = $this->allowedToReview($userid, $product);
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
        // check if user has purchased the product
        $user = Auth::user();
        $userid = $user['id'];
        $product = Product::all()->where('id', $request['product_id'])->first();
        $purchased = $this->allowedToReview($userid, $product);
        if (!$purchased) {
            return redirect()->back()->with('error', 'You must purchase the product to review it');
        }
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
    // returns a list of reviews for a product
    static function getReviews($productId) {
        // get all reviews for product
        $reviews = Review::all()->where('product_id', $productId);
        // TODO: could involve some sorting in the future
        // return them
        return $reviews;
    }

    // ensures that the user is allowed to review the product
    function allowedToReview(int $userid, Product $product): bool
    {
        // get all the orders from a user
        $orders = Order::all()->where('user_id', $userid);
        // go through each order
        foreach ($orders as $order) {
            // get all the individual orders for that order
            $individualOrders = IndividualOrder::all()->where('order_id', $order->id);
            // go through each individual order
            foreach ($individualOrders as $individualOrder) {
                // if the product was ordered return true
                if ($individualOrder->product_id == $product->id) {
                    return true;
                }
            }
        }
        // if the product was never ordered return false
        return false;
    }
}
