@extends('layouts.page')
@use(Illuminate\Support\Facades\Auth)
@use(App\Models\Basket)

@section('title', 'Checkout')
@section('script', 'js/checkout-validation.js')

@section('content')
<div class="checkout">
    <h1>Checkout</h1>
    @if($errors->any())
        <div id="errors">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Billing Information Section -->
    <section class="billing-info" id="billing-info-section">
        <h2>Billing Information</h2>
        <form id="billing-form">
            <fieldset>
                <legend>Billing Details</legend>
                <div class="form-group">
                    <label for="region">Region</label>
                    <select id="region" name="region" required aria-label="Region">
                        <option value="">Select Region</option>
                        <option value="USA">USA</option>
                        <option value="UK">United Kingdom</option>
                        <option value="CA">Canada</option>
                        <option value="AU">Australia</option>
                        <option value="IN">India</option>
                        <option value="FR">France</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="full-name">Full Name</label>
                    <input type="text" id="full-name" name="full_name" placeholder="Bruce Wayne" required>
                </div>
                <div class="form-group">
                    <label for="address">Street Address</label>
                    <input type="text" id="address" name="address" placeholder="123 Wayne Manor, Gotham City" required>
                </div>
                <div class="form-group">
                    <label for="postcode">Postcode</label>
                    <input type="text" id="postcode" name="postcode" placeholder="123456" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="123-456-7890" required>
                </div>
                <div id="billing-errors" class="error-message"></div>
                <button type="button" id="next-to-payment" onclick="nextSection('payment-method-section')">Next</button>
            </fieldset>
        </form>
    </section>

    <!-- Payment Information Section -->
    <section class="payment-method" id="payment-method-section" style="display: none;">
        <h2>Payment Method</h2>
        <form id="payment-form">
            <fieldset>
                <legend>Payment Details</legend>
                <div class="form-group">
                    <label for="card-name">Name on Card</label>
                    <input type="text" id="card-name" name="card_name" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label for="card-number">Card Number</label>
                    <input type="text" id="card-number" name="card_number" placeholder="1111-2222-3333-4444" required>
                </div>
                <div class="form-group">
                    <label for="expiry-date">Expiry Date</label>
                    <input type="text" id="expiry-date" name="expiry_date" placeholder="MM/YY" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="123" required>
                </div>
                <div id="payment-errors" class="error-message"></div>
                <button type="button" id="next-to-summary" onclick="nextSection('order-summary-section')">Next</button>
                <button type="button" id="back-to-billing" onclick="backToSection('billing-info-section')">Back</button>
            </fieldset>
        </form>
    </section>

    <!-- Order Summary Section -->
    <section class="order-summary" id="order-summary-section" style="display: none;">
        <form id="order-form" method="POST" action="{{ route('checkout.checkout') }}">
            @csrf
            <h2>Order Summary</h2>
            <ul id="order-items">
                @php($total = 0)
                @foreach(Basket::where('user_id', Auth::id())->get() as $basketItem)
                    @php($total += $basketItem->getTotalPrice())
                    <li class="order-item">{{ $basketItem->product->name }}: £{{number_format($basketItem->product->price,2) }} x {{ $basketItem->quantity }}</li>
                @endforeach
            </ul>
            <p class="total">Total: £<span id="total-price">{{ number_format($total, 2) }}</span></p>

            <!-- Hidden fields to pass billing and payment data -->
            <input type="hidden" name="region" id="region-input">
            <input type="hidden" name="full_name" id="name-input">
            <input type="hidden" name="address" id="address-input">
            <input type="hidden" name="postcode" id="postcode-input">
            <input type="hidden" name="phone" id="phone-input">
            <input type="hidden" name="card_name" id="card-name-input">
            <input type="hidden" name="card_number" id="card-number-input">
            <input type="hidden" name="expiry_date" id="expiry-date-input">
            <input type="hidden" name="cvv" id="cvv-input">

            <button type="submit" id="place-order-btn">Place Order</button>
            <button type="button" id="back-to-payment" onclick="backToSection('payment-method-section')">Back</button>
        </form>
    </section>

    <!-- Order Success Section -->
    <section id="order-success" style="display: none;">
        <h2>Order Placed Successfully!</h2>
        <p>Your order has been successfully placed. Thank you for shopping with us!</p>
    </section>
</div>
@endsection
