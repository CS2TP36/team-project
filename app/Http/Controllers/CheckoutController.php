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
        // 1) Ensure user is logged in
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        // 2) Gather user’s saved addresses, payment methods, and basket items
        $addresses = Address::where('user_id', Auth::id())->get();
        $paymentMethods = PaymentMethod::where('user_id', Auth::id())->get();
        $basketItems = Basket::with('product')->where('user_id', Auth::id())->get();

        // 3) If basket is empty, redirect to basket page
        if ($basketItems->isEmpty()) {
            return redirect('/basket')->with('error', 'Your basket is empty.');
        }

        // 4) Render checkout view with the user’s data
        return view('pages.checkout', compact('addresses', 'paymentMethods', 'basketItems'));
    }

    public function checkout(Request $request)
{
    DB::beginTransaction();
    try {
        // 1) SHIPPING ADDRESS
        if ($request->shipping_address === 'new') {
            // new shipping
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
            // existing shipping
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

        // 2) BILLING ADDRESS
        if ($request->has('same_as_shipping') && $request->same_as_shipping === 'on') {
            $billingFullName = $shippingFullName;
            $billingAddress  = $shippingAddress;
            $billingCity     = $shippingCity;
            $billingPostcode = $shippingPostcode;
        } else {
            $billingFullName = $request->input('billing_full_name');
            $billingAddress  = $request->input('billing_address');
            $billingCity     = $request->input('billing_city');
            $billingPostcode = $request->input('billing_postcode');
        }

        // 3) PAYMENT METHOD
        if ($request->payment_method === 'new') {
            $paymentCardName   = $request->input('payment_card_name');
            $paymentCardNumber = $request->input('payment_card_number');
            $paymentExpiry     = $request->input('payment_expiry');
            $paymentCVV        = $request->input('payment_cvv');

            // parse "MM/YY"
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

        // 4) BASKET NOT EMPTY
        $basket = Basket::with('product')->where('user_id', Auth::id())->get();
        if ($basket->isEmpty()) {
            throw new \Exception('Basket is empty.');
        }

        // 5) OUT-OF-STOCK CHECK
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

        // 6) CALCULATE SUBTOTAL
        $total = $basket->sum(fn($item) => $item->getTotalPrice());

        // 6b) ADD SHIPPING COST
        $shippingOption = $request->input('shipping_option', 'standard');
        $shippingCost   = 4.49; // default standard
        if ($shippingOption === 'next_day') {
            $shippingCost = 6.49;
        } elseif ($shippingOption === 'priority') {
            $shippingCost = 5.49;
        }
        $total += $shippingCost;

        // 7) DISCOUNT CODE (server-validated)
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

        // 8) CREATE ORDER
        $order = Order::create([
            'user_id'           => Auth::id(),
            'order_date'        => now(),
            'order_status'      => 'pending',
            'order_total_price' => $total, // final total with shipping + discount
            'shipping_id'       => null,
        ]);

        // 9) CREATE TRANSACTION
        $transaction = Transaction::create([
            'transaction_amount' => $total,
            'transaction_info'   => 'purchase',
            'transaction_status' => 'completed',
        ]);
        $order->transaction_id = $transaction->id;
        $order->save();

        // 10) CREATE SHIPPING RECORD
        $shipping = Shipping::create([
            'shipping_date'   => now(),
            'delivery_date'   => null,
            'home_address'    => "{$shippingFullName}, {$shippingAddress}, {$shippingCity}, {$shippingPostcode}",
            'tracking_number' => rand(100000, 999999),
        ]);
        $order->shipping_id = $shipping->id;
        $order->save();

        // 11) CREATE INDIVIDUAL ORDER ITEMS
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

        // 12) UPDATE STOCK & CLEAR BASKET
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
        // SUCCESS PAGE
        return view('pages.success')->with([
            'orderNumber'    => $order->id,
            'trackingNumber' => $shipping->tracking_number,
            'finalTotal'     => $total, // If you want to show final total in success page
        ]);

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
