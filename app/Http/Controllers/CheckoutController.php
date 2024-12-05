<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index() {
        // checks if user is logged in
        if (!Auth::check()) {
            return redirect('/login');
        }
        // gets users basket items
        $basket = Basket::all()->where('user_id', Auth::id());
        // takes them back to the basket if they have no items
        if ($basket->isEmpty()) {
            return redirect('/basket');
        }
        return view('pages.checkout');
    }
}
