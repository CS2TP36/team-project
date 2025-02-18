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
use Illuminate\Support\Facades\Log;

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

            // get values from the request

            $values = $request->only([
                'region', 'full_name', 'address', 'postcode', 'phone',
                'card_name', 'card_number', 'expiry_date', 'cvv'
            ]);

            // get relevent basket items
            $basket = Basket::with('product')->where('user_id', Auth::id())->get();

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
                // to reduce the stock level of hte given item
                $product = $basketItem->product;
                $product['quantity'] = $product['quantity'] - $basketItem->quantity;
                // add to popularity count (5 for each order)
                $product['popularity'] = $product['popularity'] + (5 * $basketItem->quantity);
                // save the product
                $product->save();
                // then delete the item from the basket
                $basketItem->delete();
            }

            // commit to db

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
            return redirect()->route('checkout.checkout')->withErrors('An error occurred. Please try again later.');

        }

    }
}
