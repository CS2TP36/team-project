<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// a class for getting all of the previous orders for a user
class PreviousOrders extends Controller
{
    function show() {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return view('pages.previous-orders');
    }
    function getPreviousOrders(User $user) {
        $orders = Order::all()->where('user_id', $user["id"]);
        return $orders;
    }
}
