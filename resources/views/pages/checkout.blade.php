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

        <div class="checkout-container">
            <section class="checkout-section" id="billing-info-section">
                <h2>Billing Information</h2>
                <form id="billing-form">
                    <fieldset>
                        <legend>Billing Details</legend>
                        <div class="form-group">
                            <label for="full-name">Full Name</label>
                            <input type="text" id="full-name" name="full_name" placeholder="Input Full Name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Street Address</label>
                            <input type="text" id="address" name="address" placeholder="Street Address" required>
                        </div>
                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input type="text" id="postcode" name="postcode" placeholder="Between 5-7 digit" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="" required>
                        </div>
                        <div id="billing-errors" class="error-message"></div>
                        <button type="button" class="next-section" data-next="payment-method-section">Next</button>
                    </fieldset>
                </form>
            </section>

            <section class="checkout-section" id="payment-method-section" style="display: none;">
                <h2>Payment Method</h2>
                <form id="payment-form">
                    <fieldset>
                        <legend>Payment Details</legend>
                        <div class="form-group">
                            <label for="card-name">Name on Card</label>
                            <input type="text" id="card-name" name="card_name" placeholder="Input Name on Card" required>
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
                        <button type="button" class="next-section" data-next="shipping-info-section">Next</button>
                        <button type="button" class="back-section" data-back="billing-info-section">Back</button>
                    </fieldset>
                </form>
            </section>

            <section class="checkout-section" id="shipping-info-section" style="display: none;">
                <h2>Shipping Information</h2>
                <form id="shipping-form">
                    <fieldset>
                        <legend>Shipping Options</legend>
                        <div class="form-group">
                            <label>
                                <input type="radio" name="shipping_option" value="standard" required>
                                Standard Delivery: 4-7 days (£4.49)
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="radio" name="shipping_option" value="next_day" required>
                                Next Day Delivery: Orders by 7 PM (£6.49)
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="radio" name="shipping_option" value="priority" required>
                                Priority Express Delivery: 2-3 days (£5.49)
                            </label>
                        </div>
                        <div id="shipping-errors" class="error-message"></div>
                        <button type="button" class="next-section" data-next="discount-section">Next</button>
                        <button type="button" class="back-section" data-back="payment-method-section">Back</button>
                    </fieldset>
                </form>
            </section>

            <section class="checkout-section" id="discount-section" style="display: none;">
                <h2>Discount Code</h2>
                <form id="discount-form">
                    <fieldset>
                        <legend>Apply Discount</legend>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" id="apply-discount" name="apply_discount"> Apply Discount Code?
                            </label>
                        </div>
                        <div id="discount-code-input" style="display: none;">
                            <div class="form-group">
                                <label for="discount_code">Discount Code</label>
                                <input type="text" id="discount_code" name="discount_code">
                            </div>
                        </div>
                        <div id="discount-errors" class="error-message"></div>
                        <button type="button" class="next-section" data-next="order-summary-section">Next</button>
                        <button type="button" class="back-section" data-back="shipping-info-section">Back</button>
                    </fieldset>
                </form>
            </section>

            <section class="checkout-section" id="order-summary-section" style="display: none;">
                <form id="order-form" method="POST" action="{{ route('checkout.checkout') }}">
                    @csrf
                    <h2>Order Summary</h2>
                    <ul id="order-items">
                        @php($total = 0)
                        @foreach(Basket::where('user_id', Auth::id())->get() as $basketItem)
                            @php($total += $basketItem->getTotalPrice())
                            <li class="order-item">{{ $basketItem->product->name }}:
                                £{{number_format($basketItem->product->price,2) }} x {{ $basketItem->quantity }}</li>
                        @endforeach
                    </ul>
                    <p class="total">Total: £<span id="total-price">{{ number_format($total, 2) }}</span></p>
                    <p class="total">Shipping: £<span id="shipping-price">0.00</span></p>
                    <p class="total">Discount: -£<span id="discount-amount">0.00</span></p>
                    <p class="total">Grand Total: £<span id="grand-total">0.00</span></p>

                    <input type="hidden" name="region" id="region-input">
                    <input type="hidden" name="full_name" id="name-input">
                    <input type="hidden" name="address" id="address-input">
                    <input type="hidden" name="postcode" id="postcode-input">
                    <input type="hidden" name="phone" id="phone-input">
                    <input type="hidden" name="card_name" id="card-name-input">
                    <input type="hidden" name="card_number" id="card-number-input">
                    <input type="hidden" name="expiry_date" id="expiry-date-input">
                    <input type="hidden" name="cvv" id="cvv-input">
                    <input type="hidden" name="shipping_option" id="shipping-input">
                    <input type="hidden" name="discount_code" id="discount-code-input-final">
                    <input type="hidden" name="discount_applied" id="discount-applied-input">

                    <button type="submit" id="place-order-btn">Place Order</button>
                    <button type="button" class="back-section" data-back="discount-section">back</button>
                </form>
            </section>

            <section id="order-success" style="display: none;">
                <h2>Order Placed Successfully!</h2>
                <p>Your order has been successfully placed. Thank you for shopping with us!</p>
            </section>
        </div>
    </div>
@endsection
