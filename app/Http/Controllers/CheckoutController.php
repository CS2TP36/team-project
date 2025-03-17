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
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        $addresses = Address::where('user_id', Auth::id())->get();
        $paymentMethods = PaymentMethod::where('user_id', Auth::id())->get();
        $basketItems = Basket::with('product')->where('user_id', Auth::id())->get();

        if ($basketItems->isEmpty()) {
            return redirect('/basket')->with('error', 'Your basket is empty.');
        }

        return view('pages.checkout', compact('addresses', 'paymentMethods', 'basketItems'));
    }

    public function checkout(Request $request)
    {
        DB::beginTransaction();

        try {
            $address = Address::where('user_id', Auth::id())->find($request->shipping_address);
            $paymentMethod = PaymentMethod::where('user_id', Auth::id())->find($request->payment_method);

            if (!$address) {
                throw new \Exception('Invalid shipping address.');
            }
            if (!$paymentMethod) {
                throw new \Exception('Invalid payment method.');
            }

            $values = [
                'full_name'    => $request->billing_full_name ?? $address->full_name,
                'address'      => $request->billing_address ?? $address->address_line1,
                'postcode'     => $request->billing_postcode ?? $address->post_code,
                'phone'        => $request->phone,
                'card_name'    => $paymentMethod->card_name,
                'card_number'  => $paymentMethod->card_number,
                'expiry_date'  => $paymentMethod->expiry_date,
                'cvv'          => $paymentMethod->cvv,
                'discount_code'=> $request->discount_code ?? null,
            ];

            // get relevent basket items
            $basket = Basket::with('product')->where('user_id', Auth::id())->get();

            if ($basket->isEmpty()) {
                throw new \Exception('Basket is empty.');
            }

            $total = $basket->sum(fn($item) => $item->getTotalPrice());

            if ($values['discount_code']) {
                $discount = DiscountCode::where('code', $values['discount_code'])->first();
                if ($discount && $discount->isValid()) {
                    $total = $discount->applyDiscount($total);
                }
            }
            // TODO: test if the above works after checkout page is reworked

            // create a new order
            $order = Order::create([
                'user_id'           => Auth::id(),
                'order_date'        => now(),
                'order_status'      => 'pending',
                'order_total_price' => $total,
                'shipping_id'       => null,
            ]);

            // create a transaction for the order
            $transaction = Transaction::create([
                'transaction_amount' => $total,
                'transaction_info'   => 'purchase',
                'transaction_status' => 'completed',
            ]);

            // link the transaction to the order
            $order->transaction_id = $transaction->id;
            $order->save();

            // create the shipping item
            $shipping = Shipping::create([
                'shipping_date'   => now(),
                'delivery_date'   => null,
                'home_address'    => "{$values['full_name']}, {$values['address']}, {$values['postcode']}",
                'tracking_number' => rand(100000, 999999),
            ]);

            // link shipping to order
            $order->shipping_id = $shipping->id;
            $order->save();
            // convert every basket item into and individualOrder item

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

            foreach ($basket as $basketItem) {
                // to reduce the stock level of hte given item
                $product = $basketItem->product;
                $product->stock -= $basketItem->quantity;
                $product->save();
                // then delete the item from the basket
                $basketItem->delete();
            }

            // commit to db

            DB::commit();

            // send the order confirmation email
            $mailer = new OrderEmailer();
            $mailer->sendOrderConfirmation($order);
            // actually delete the emailer after sending
            unset($mailer);

            return view('pages.success')->with([
                'orderNumber'    => $order['id'],
                'trackingNumber' => $shipping['tracking_number']
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage(), [
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Redirect back with an error message
            return redirect()->route('checkout.checkout')->withErrors('An error occurred. Please try again later.');
        }
    }
}