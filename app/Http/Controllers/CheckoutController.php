<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Shipping;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\IndividualOrder;

class CheckoutController extends Controller
{
    // Display the checkout page
    public function index() {
        // Check if the user is logged in
        if (!Auth::check()) {
            // Redirect to login page if not logged in
            return redirect('/login');
        }

        // Get the user's basket items
        $basket = Basket::all()->where('user_id', Auth::id());

        // Redirect to basket page if the basket is empty
        if ($basket->isEmpty()) {
            return redirect('/basket');
        }

        // Return the checkout view
        return view('pages.checkout');
    }

    // Handle the checkout process
    public function checkout(Request $request)
    {
        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Extract relevant values from the request
            $values = $request->only([
                'region', 'full_name', 'address', 'postcode', 'phone',
                'card_name', 'card_number', 'expiry_date', 'cvv'
            ]);

            // Get the user's basket items with associated products
            $basket = Basket::with('product')->where('user_id', Auth::id())->get();

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

            foreach ($basket as $basketItem) {
                Log::info('Processing basket item:', $basketItem->toArray());
                if (!$basketItem->product || !$basketItem->product->price) {
                    throw new \Exception('Basket item product or price is missing');
                }
    
                IndividualOrder::create([
                    'order_id' => $order->id,
                    'product_id' => $basketItem->product_id,
                    'quantity' => $basketItem->quantity,
                    'price' => $basketItem->product->price, 
                    'size' => $basketItem->size, 
                ]);
            }

            foreach ($basket as $basketItem) {
                $basketItem->delete();
            }

            // Commit the transaction if everything is successful
            DB::commit();

            return view('pages.success')->with(['orderNumber' => $order['id'], 'trackingNumber' => $shipping['tracking_number']]);

        }catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
        
            // Log the error for debugging
            Log::error('Checkout error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
        
            // Redirect back with an error message
            return redirect()->route('checkout')->withErrors('An error occurred. Please try again later.');
        }
        
    }
}
