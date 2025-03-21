<?php

namespace App\Http\Controllers;

use App\Http\Emailers\OrderEmailer;
use App\Models\DiscountCode;
use App\Models\IndividualOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\PaymentMethod;
use App\Models\Basket;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Shipping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        // Ensures user is logged in
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        // Gathers user’s saved addresses, payment methods, and basket items
        $addresses = Address::where('user_id', Auth::id())->get();
        $paymentMethods = PaymentMethod::where('user_id', Auth::id())->get();
        $basketItems = Basket::with('product')->where('user_id', Auth::id())->get();

        // If basket is empty, redirect to basket page
        if ($basketItems->isEmpty()) {
            return redirect('/basket')->with('error', 'Your basket is empty.');
        }

        // Shows checkout page with the user’s data
        return view('pages.checkout', compact('addresses', 'paymentMethods', 'basketItems'));
    }

    public function checkout(Request $request)
{
    DB::beginTransaction();
    try {
        // Shipping Address
        if ($request->shipping_address === 'new') {
            // for new addresses
            $shippingFullName = $request->input('shipping_full_name');
            $shippingAddress  = $request->input('shipping_address_line1');
            $shippingCity     = $request->input('shipping_city');
            $shippingPostcode = $request->input('shipping_post_code');
            $shippingPhone    = $request->input('shipping_phone');

            if ($request->has('save_new_address')) {
                Address::create([
                    'user_id'       => Auth::id(),
                    'full_name'     => $shippingFullName,
                    'address_line1' => $shippingAddress,
                    'town_city'     => $shippingCity,
                    'post_code'     => $shippingPostcode,
                    'phone_number'  => $shippingPhone,
                ]);
            }
        } else {
            // for saved addresses
            $address = Address::where('user_id', Auth::id())
                ->find($request->shipping_address);

            if (!$address) {
                throw new \Exception('Invalid shipping address.');
            }

            $shippingFullName = $address->full_name;
            $shippingAddress  = $address->address_line1;
            $shippingCity     = $address->town_city;
            $shippingPostcode = $address->post_code;
            $shippingPhone    = $address->phone_number;
        }
        
        // Payment Methods
        if ($request->payment_method === 'new') {
            $paymentCardName   = $request->input('payment_card_name');
            $paymentCardNumber = $request->input('payment_card_number');
            $paymentExpiry     = $request->input('payment_expiry');
            $paymentCVV        = $request->input('payment_cvv');

            // Parses expiry date into month and year for database
            if (strpos($paymentExpiry, '/') !== false) {
                [$expMonth, $expYear] = explode('/', $paymentExpiry);
                $expMonth = trim($expMonth);
                $expYear  = trim($expYear);
            } else {
                throw new \Exception('Invalid expiry format. Use MM/YY');
            }

            if ($request->has('save_new_payment')) {
                PaymentMethod::create([
                    'user_id'      => Auth::id(),
                    'card_name'    => $paymentCardName,
                    'card_number'  => $paymentCardNumber,
                    'expiry_month' => $expMonth,
                    'expiry_year'  => $expYear,
                    'cvv'          => $paymentCVV,
                ]);
            }
        } else {
            $paymentMethod = PaymentMethod::where('user_id', Auth::id())
                ->find($request->payment_method);

            if (!$paymentMethod) {
                throw new \Exception('Invalid payment method.');
            }
        }

        // If basket is empty
        $basket = Basket::with('product')->where('user_id', Auth::id())->get();
        if ($basket->isEmpty()) {
            throw new \Exception('Basket is empty.');
        }

        // Checks if any items are out of stock
        $outOfStockItems = [];
        foreach ($basket as $item) {
            if (!$item->product || $item->product->stock < $item->quantity) {
                $outOfStockItems[] = $item;
            }
        }
        if (!empty($outOfStockItems)) {
            DB::rollBack();
            return view('pages.checkout_out_of_stock', compact('outOfStockItems'));
        }

        // Calculates the basket total
        $total = $basket->sum(fn($item) => $item->getTotalPrice());

        // Adds the shipping cost to toal
        $shippingOption = $request->input('shipping_option', 'standard');
        $shippingCost   = 4.49; //default price
        if ($shippingOption === 'next_day') {
            $shippingCost = 6.49;
        } elseif ($shippingOption === 'priority') {
            $shippingCost = 5.49;
        }
        $total += $shippingCost;

        // Validates and applies discont codes
        if ($request->filled('discount_code') && $request->input('apply_discount') === '1') {
            $discount = DiscountCode::where('code', $request->discount_code)->first();

            if (!$discount || !$discount->isValid()) {
                DB::rollBack();
                return redirect()->route('checkout.checkout')
                    ->withErrors('Invalid or expired discount code.');
            } else {
                $total = $discount->applyDiscount($total);
            }
        }

        // Creates an order
        $order = Order::create([
            'user_id'           => Auth::id(),
            'order_date'        => now(),
            'order_status'      => 'pending',
            'order_total_price' => $total, // final total with shipping + discount
            'shipping_id'       => null,
        ]);

        // Creates a transaction
        $transaction = Transaction::create([
            'transaction_amount' => $total,
            'transaction_info'   => 'purchase',
            'transaction_status' => 'completed',
        ]);
        $order->transaction_id = $transaction->id;
        $order->save();

        // Creates shipping records
        $shipping = Shipping::create([
            'shipping_date'   => now(),
            'delivery_date'   => null,
            'home_address'    => "{$shippingFullName}, {$shippingAddress}, {$shippingCity}, {$shippingPostcode}",
            'tracking_number' => rand(100000, 999999),
        ]);
        $order->shipping_id = $shipping->id;
        $order->save();

        // Creates Individual Order Items
        foreach ($basket as $basketItem) {
            if (!$basketItem->product || !$basketItem->product->price) {
                throw new \Exception('Basket item product or price is missing.');
            }

            IndividualOrder::create([
                'order_id'   => $order->id,
                'product_id' => $basketItem->product_id,
                'quantity'   => $basketItem->quantity,
                'price'      => $basketItem->product->price,
                'size'       => $basketItem->size,
            ]);
        }

        // Updates stock levels and basket
        foreach ($basket as $basketItem) {
            $product = $basketItem->product;
            $product->stock -= $basketItem->quantity;
            $product->popularity += (5 * $basketItem->quantity);
            $product->save();
            $basketItem->delete();
        }

        DB::commit();

        // only email if email is setup on machine
        if (env('MAILGUN_SECRET')) {
            // create a mailer and send the order confirmation email
            $mailer = new OrderEmailer();
            $mailer->sendOrderConfirmation($order);
            unset($mailer);
        }
        // Redirects to success page
        return view('pages.success')->with([
            'orderNumber'    => $order->id,
            'trackingNumber' => $shipping->tracking_number,
            'finalTotal'     => $total, // If you want to show final total in success page
        ]);

        // Catches errors and rolls back
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Checkout error: ' . $e->getMessage(), [
            'file'  => $e->getFile(),
            'line'  => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->route('checkout.checkout')
            ->withErrors('An error occurred: ' . $e->getMessage());
    }
}
}
