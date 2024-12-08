<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Shipping;
use App\Models\Basket; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        DB::beginTransaction();

        try {
            $values = $request->only([
                'region', 'full_name', 'address', 'postcode', 'phone',
                'card_name', 'card_number', 'expiry_date', 'cvv'
            ]);

            $basket = Basket::where('user_id', Auth::id())->get();  

            $total = $basket->sum(fn($item) => $item->getTotalPrice());

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_date' => now(),
                'order_status' => 'pending',  
                'order_total_price' => $total,
                'shipping_id' => null,  
            ]);

            
            $transaction = Transaction::create([
                'transaction_amount' => $total,
                'transaction_info' => 'purchase',
                'transaction_status' => 'completed',
            ]);

            $order->transaction_id = $transaction->id;
            $order->save();

            $shipping = Shipping::create([
                'shipping_date' => now(),
                'delivery_date' => null,
                'home_address' => "{$values['full_name']}, {$values['address']}, {$values['postcode']}",
                'tracking_number' => rand(100000, 999999), 
            ]);

            $order->shipping_id = $shipping->id;
            $order->save();

            DB::commit();

            return redirect()->route('order.success', ['order' => $order->id]);

        } catch (\Exception $e) {
            DB::rollBack();

            

            return redirect()->route('checkout')->withErrors('An error occurred. Please try again later.');
        }
    }
}