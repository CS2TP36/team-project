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
            // 1) Handle shipping address (existing or new)
            if ($request->shipping_address === 'new') {
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
                // The user selected an existing address ID
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

            // 2) Handle billing address
            if ($request->has('same_as_shipping') && $request->same_as_shipping == 'on') {
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

            // 3) Handle payment method (existing or new)
            if ($request->payment_method === 'new') {
                $paymentCardName   = $request->input('payment_card_name');
                $paymentCardNumber = $request->input('payment_card_number');
                // Separate expiry month/year instead of a single expiry_date
                $paymentExpiryMonth = $request->input('payment_expiry_month'); // e.g. "03"
                $paymentExpiryYear  = $request->input('payment_expiry_year');  // e.g. "24"
                $paymentCVV         = $request->input('payment_cvv');

                if ($request->has('save_new_payment')) {
                    PaymentMethod::create([
                        'user_id'      => Auth::id(),
                        'card_name'    => $paymentCardName,
                        'card_number'  => $paymentCardNumber,
                        'expiry_month' => $paymentExpiryMonth,
                        'expiry_year'  => $paymentExpiryYear,
                        'cvv'          => $paymentCVV,
                    ]);
                }
            } else {
                // The user selected an existing payment method
                $paymentMethod = PaymentMethod::where('user_id', Auth::id())
                    ->find($request->payment_method);

                if (!$paymentMethod) {
                    throw new \Exception('Invalid payment method.');
                }
            }

            // 4) Validate basket is not empty
            $basket = Basket::with('product')->where('user_id', Auth::id())->get();
            if ($basket->isEmpty()) {
                throw new \Exception('Basket is empty.');
            }

            // 5) Check for out-of-stock items
            $outOfStockItems = [];
            foreach ($basket as $basketItem) {
                if (!$basketItem->product || $basketItem->product->stock < $basketItem->quantity) {
                    $outOfStockItems[] = $basketItem;
                }
            }
            if (!empty($outOfStockItems)) {
                DB::rollBack();
                return view('pages.checkout_out_of_stock', compact('outOfStockItems'));
            }

            // 6) Calculate total
            $total = $basket->sum(fn($item) => $item->getTotalPrice());

            // 7) Apply discount code if any
            if ($request->filled('discount_code')) {
                $discount = DiscountCode::where('code', $request->discount_code)->first();
                if ($discount && $discount->isValid()) {
                    $total = $discount->applyDiscount($total);
                }
            }

            // 8) Create order
            $order = Order::create([
                'user_id'           => Auth::id(),
                'order_date'        => now(),
                'order_status'      => 'pending',
                'order_total_price' => $total,
                'shipping_id'       => null,
            ]);

            // 9) Create transaction
            $transaction = Transaction::create([
                'transaction_amount' => $total,
                'transaction_info'   => 'purchase',
                'transaction_status' => 'completed',
            ]);
            $order->transaction_id = $transaction->id;
            $order->save();

            // 10) Create shipping record
            $shipping = Shipping::create([
                'shipping_date'   => now(),
                'delivery_date'   => null,
                'home_address'    => "{$shippingFullName}, {$shippingAddress}, {$shippingCity}, {$shippingPostcode}",
                'tracking_number' => rand(100000, 999999),
            ]);
            $order->shipping_id = $shipping->id;
            $order->save();

            // 11) Convert basket items into individual orders
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

            // 12) Update stock & popularity, clear basket
            foreach ($basket as $basketItem) {
                $product = $basketItem->product;
                $product->stock -= $basketItem->quantity;
                $product->popularity += (5 * $basketItem->quantity);
                $product->save();
                $basketItem->delete();
            }

            DB::commit();

            // Send confirmation email
            $mailer = new OrderEmailer();
            $mailer->sendOrderConfirmation($order);
            unset($mailer);

            // Success page
            return view('pages.success')->with([
                'orderNumber'    => $order->id,
                'trackingNumber' => $shipping->tracking_number
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