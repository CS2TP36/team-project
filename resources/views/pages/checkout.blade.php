@extends('layouts.page')
@section('title', 'Checkout')
@section('script', 'js/checkout-validation.js')
@section('content')
    <div class="checkout">
        <h1>Checkout</h1>
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
                        <input type="text" id="full-name" name="full-name" placeholder="Bruce Wayne" required aria-label="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="address">Street Address</label>
                        <input type="text" id="address" name="address" placeholder="123 Wayne Manor, Gotham City" required aria-label="Street Address">
                    </div>
                    <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input type="text" id="postcode" name="postcode" placeholder="HI" required aria-label="Postcode">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="123-456-7890" required aria-label="Phone Number">
                    </div>
                    <div id="billing-errors" class="error-message"></div>
                    <button type="button" id="next-to-payment" onclick="nextSection('payment')">Next</button>
                </fieldset>
            </form>
        </section>

        <section class="payment-method" id="payment-method-section" style="display: none;">
            <h2>Payment Method</h2>
            <form id="payment-form">
                <fieldset>
                    <legend>Payment Details</legend>
                    <div class="form-group">
                        <label for="name-on-card">Name on Card</label>
                        <input type="text" id="name-on-card" name="name-on-card" placeholder="John Doe" required aria-label="Name on Card">
                    </div>
                    <div class="form-group">
                        <label for="card-number">Card Number</label>
                        <input type="text" id="card-number" name="card-number" placeholder="1111-2222-3333-4444" required aria-label="Card Number">
                    </div>
                    <div class="form-group">
                        <label for="expiry-date">Expiry Date</label>
                        <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY" required aria-label="Expiry Date">
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="123" required aria-label="CVV">
                    </div>
                    <div id="payment-errors" class="error-message"></div>
                    <button type="button" id="next-to-summary" onclick="nextSection('summary')">Next</button>
                </fieldset>
            </form>
        </section>

        <section class="order-summary" id="order-summary-section" style="display: none;">
            <form id="order-form" method="POST" action="{{route('checkout.checkout')}}">
                @csrf
                <h2>Order Summary</h2>
                <ul id="order-items"></ul>
                <p class="total">Total: £<span id="total-price">0.00</span></p>

                <input name="final-value" type="hidden" id="region">
                <input name="final-value" type="hidden" id="name">
                <input name="final-value" type="hidden" id="address">
                <input name="final-value" type="hidden" id="postcode">
                <input name="final-value" type="hidden" id="phone">
                <input name="final-value" type="hidden" id="card-name">
                <input name="final-value" type="hidden" id="card-number">
                <input name="final-value" type="hidden" id="expiry-date">
                <input name="final-value" type="hidden" id="cvv">

                <button type="button" id="place-order-btn" onclick="placeOrder()">Place Order</button>
                <button type="button" id="back-to-payment" onclick="backToPayment()">Back</button>
            </form>
        </section>

        <section id="order-success" style="display: none;">
            <h2>Order Placed Successfully!</h2>
            <p>Your order has been successfully placed. Thank you for shopping with us!</p>
        </section>
    </div>
@endsection
