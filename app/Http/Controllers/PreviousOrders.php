<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// a class for getting all of the previous orders for a user
class PreviousOrders extends Controller
{
    // loads the page with the default 10 orders
    function show() {
        if (!Auth::check()) {
            return redirect('/login/previous-orders')->with('error', 'You are not logged in');
        }
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        // return the view with the orders
        return view('pages.previous-orders', compact('orders'));
    }
    // to load more orders, probably the only ajax in the whole project (had to do this or it takes hours to load)
    public function loadMore(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login/previous-orders')->with('error', 'You are not logged in');
        }

        $user = Auth::user();
        // gets page number from the request or defaults to first page
        $page = $request->input('page', 1);

        // get the next 10 orders for the correct page
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10, page: $page);

        // if its an ajax request render the blade file then return it
        if ($request->ajax()) {
            return view('reusables.previous-orders', compact('orders'))->render();
        }
        // if its not an ajax request return an error
        return response()->json(['error' => 'Invalid request'], 400);
    }

}
