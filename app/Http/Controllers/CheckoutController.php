<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\IndividualOrder;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\Transaction;
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

    public function checkout(Request $request) {
        // validates all the values sent
        $values = $request->validate([
            'region' => 'required',
            'name' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
            'card-name' => 'required',
            'card-number' => 'required',
            'expiry-date' => 'required',
            'cvv' => 'required'
        ]);
        // gets the basket items as an array
        $basket = Basket::all()->where('user_id', Auth::id());
        $total = 0;
        foreach ($basket as $item) {
            $total += $item->getPrice();
        }
        // create a new transaction
        $transaction = new Transaction([
            'transaction_amount' => $total,
            'transaction_info' => 'purchase',
            'transaction_status' => 'complete'
        ]);
        // create a new shipping item
        $shipping = new Shipping([
            'shipping_date' => today(),
            'delivery_date' => null,
            'home_address' => $values['name'].', '.$values['address'].', '.$values['postcode'],
            'tracking_number' => rand(100000, 999999)
        ]);
        // creates a new order
        $order = new Order([
            'user_id' => Auth::id(),
            'order_date' => now(),
            'order_status' => 'pending',
            'order_total_price' => $total,
            'shipping_id' => $shipping['id'],
            'transaction_id' => $transaction['id']
        ]);
        // save the things which are complete
        $transaction->save();
        $order->save();
        $shipping->save();
        // convert every basket item into and individualOrder item
        foreach ($basket as $basketItem) {
            $individualOrder = new IndividualOrder([
                'order_id' => $order['id'],
                'product_id' => $basketItem['product_id'],
                'quantity' => $basketItem['quantity'],
                'price' => $basketItem->product()['price'],
                'size' => $basketItem['size'],
            ]);
        }
    }
}
