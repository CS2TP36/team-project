<?php

namespace App\Http\Controllers;

use App\Models\IndividualOrder;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Shipping;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
    public function checkout(Request $request)
    {
        DB::beginTransaction();

        try {
            // get values from the request
            $values = $request->only([
                'region', 'full_name', 'address', 'postcode', 'phone',
                'card_name', 'card_number', 'expiry_date', 'cvv'
            ]);
            // get relevent basket items
            $basket = Basket::where('user_id', Auth::id())->get();
            // get the total price
            $total = $basket->sum(fn($item) => $item->getTotalPrice());
            // create a new order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_date' => now(),
                'order_status' => 'pending',
                'order_total_price' => $total,
                'shipping_id' => null,
            ]);

            // create a transaction for the order
            $transaction = Transaction::create([
                'transaction_amount' => $total,
                'transaction_info' => 'purchase',
                'transaction_status' => 'completed',
            ]);

            // link the transaction to the order
            $order->transaction_id = $transaction->id;
            $order->save();

            // create the shipping item
            $shipping = Shipping::create([
                'shipping_date' => now(),
                'delivery_date' => null,
                'home_address' => "{$values['full_name']}, {$values['address']}, {$values['postcode']}",
                'tracking_number' => rand(100000, 999999),
            ]);

            // link shipping to order
            $order->shipping_id = $shipping->id;
            $order->save();

            // convert every basket item into and individualOrder item
            /*
            foreach ($basket as $basketItem) {
                $individualOrder = new IndividualOrder([
                    'order_id' => $order->id,
                    'product_id' => $basketItem->product->id,
                    'quantity' => $basketItem->quantity,
                    'price' => $basketItem->product->price,
                    'size' => $basketItem->size
                ]);
                $individualOrder->save();
            }
               */
            // delete all the basket items for that user
            foreach ($basket as $item) {
                $item->delete();
            }

            // commit to db
            DB::commit();

            return view('pages.success')->with(['orderNumber' => $order['id'], 'trackingNumber' => $shipping['tracking_number']]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('checkout.checkout')->withErrors('An error occurred. Please try again later.');
        }
    }
}
