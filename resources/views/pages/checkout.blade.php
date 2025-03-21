@extends('layouts.page')
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

        <!-- Shipping Address Section -->
        <section class="checkout-section" id="shipping-info-section">
            <h2>Shipping Information</h2>
            <form id="shipping-form">
                <fieldset>
                    <legend>Shipping Address</legend>

                    @if($addresses->count() > 0)
                        <!-- If user has saved addresses, also show option to add a new address -->
                        <div class="form-group">
                            <p>Select a saved address:</p>
                            @php($count=0)
                            @foreach($addresses as $address)
                                @php($count++)
                                <label style="display:block; margin-bottom:0.5em;">
                                    <input type="radio" name="shipping_address" value="{{ $address->id }}" required {{ $count == 1 ? 'checked' : '' }}>
                                    {{ $address->full_name }}, {{ $address->address_line1 }},
                                    {{ $address->town_city }}, {{ $address->post_code }}
                                </label>
                            @endforeach
                            <label style="display:block; margin-top:1em;">
                                <input type="radio" name="shipping_address" value="new" required>
                                Use a new address
                            </label>
                        </div>

                        <fieldset id="new-shipping-fields" style="display:none; margin-top:1em;">
                            <legend>New Shipping Address</legend>
                            <div class="form-group">
                                <label for="shipping_full_name">Full Name</label>
                                <input type="text" id="shipping_full_name" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <label for="shipping_address_line1">Street Address</label>
                                <input type="text" id="shipping_address_line1" placeholder="Street Address">
                            </div>
                            <div class="form-group">
                                <label for="shipping_city">City</label>
                                <input type="text" id="shipping_city" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="shipping_post_code">Postcode</label>
                                <input type="text" id="shipping_post_code" placeholder="Postcode">
                            </div>
                            <div class="form-group">
                                <label for="shipping_phone">Phone Number</label>
                                <input type="tel" id="shipping_phone" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" id="save_new_address">
                                    Save this address for future?
                                </label>
                            </div>
                        </fieldset>
                    @else
                        <!-- hidden radio needed for JS to see new shipping address -->
                        <p>You have no saved addresses. Please enter a new address below:</p>
                        <label style="display:none;">
                            <input type="radio" name="shipping_address" value="new" checked>
                        </label>

                        <fieldset id="new-shipping-fields" style="margin-top:1em;">
                            <legend>New Shipping Address</legend>
                            <div class="form-group">
                                <label for="shipping_full_name">Full Name</label>
                                <input type="text" id="shipping_full_name" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <label for="shipping_address_line1">Street Address</label>
                                <input type="text" id="shipping_address_line1" placeholder="Street Address">
                            </div>
                            <div class="form-group">
                                <label for="shipping_city">City</label>
                                <input type="text" id="shipping_city" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="shipping_post_code">Postcode</label>
                                <input type="text" id="shipping_post_code" placeholder="Postcode">
                            </div>
                            <div class="form-group">
                                <label for="shipping_phone">Phone Number</label>
                                <input type="tel" id="shipping_phone" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" id="save_new_address">
                                    Save this address for future?
                                </label>
                            </div>
                        </fieldset>
                    @endif
<!--
                    <div class="form-group" style="margin-top:1em;">
                        <label>
                            <input type="checkbox" id="same_as_shipping" checked>
                            Billing address same as shipping?
                        </label>
                    </div>
                    -->
                </fieldset>
                <button type="button" class="next-section" data-next="payment-method-section" id="shipping-next-btn">
                    Next
                </button>
            </form>
        </section>

        <!-- Billing Address Section -->
        <!--
        <section class="checkout-section" id="billing-info-section" style="display:none;">
            <h2>Billing Information</h2>
            <form id="billing-form">
                <fieldset>
                    <legend>Billing Details</legend>
                    <div id="billing-fields" style="display:none;">
                        <div class="form-group">
                            <label for="billing_full_name">Full Name</label>
                            <input type="text" id="billing_full_name" placeholder="Input Full Name">
                        </div>
                        <div class="form-group">
                            <label for="billing_address">Street Address</label>
                            <input type="text" id="billing_address" placeholder="Street Address">
                        </div>
                        <div class="form-group">
                            <label for="billing_postcode">Postcode</label>
                            <input type="text" id="billing_postcode" placeholder="Between 5-7 digit">
                        </div>
                        <div class="form-group">
                            <label for="billing_city">City</label>
                            <input type="text" id="billing_city" placeholder="City">
                        </div>
                    </div>
                    <button type="button" class="next-section" data-next="payment-method-section">Next</button>
                    <button type="button" class="back-section" data-back="shipping-info-section">Back</button>
                </fieldset>
            </form>
        </section>
        -->

        <!-- Payment Method Section -->
        <section class="checkout-section" id="payment-method-section" style="display:none;">
            <h2>Payment Method</h2>
            <form id="payment-form">
                <fieldset>
                    <legend>Payment Details</legend>

                    @if($paymentMethods->count() > 0)
                        <div class="form-group">
                            <p>Select a saved payment method:</p>
                            @php($count=0)
                            @foreach ($paymentMethods as $method)
                                @php($count++)
                                <label style="display:block; margin-bottom:0.5em;">
                                    <input type="radio" name="payment_method" value="{{ $method->id }}" required {{ $count == 1 ? 'checked' : '' }}>
                                    {{ $method->card_name }} - **** **** **** {{ substr($method->card_number, -4) }}
                                </label>
                            @endforeach
                            <label style="display:block; margin-top:1em;">
                                <input type="radio" name="payment_method" value="new" required>
                                Use a new payment method
                            </label>
                        </div>

                        <fieldset id="new-payment-fields" style="display:none; margin-top:1em;">
                            <legend>New Payment Method</legend>
                            <div class="form-group">
                                <label for="payment_card_name">Name on Card</label>
                                <input type="text" id="payment_card_name" placeholder="Input Name on Card">
                            </div>
                            <div class="form-group">
                                <label for="payment_card_number">Card Number</label>
                                <input type="text" id="payment_card_number" placeholder="1111-2222-3333-4444">
                            </div>
                            <div class="form-group">
                                <label for="payment_expiry">Expiry Date</label>
                                <input type="text" id="payment_expiry" placeholder="MM/YY">
                            </div>
                            <div class="form-group">
                                <label for="payment_cvv">CVV</label>
                                <input type="text" id="payment_cvv" placeholder="123">
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" id="save_new_payment">
                                    Save this payment method for future?
                                </label>
                            </div>
                        </fieldset>
                    @else
                        <p>You have no saved payment methods. Please enter a new method below:</p>
                        <label style="display:none;">
                            <input type="radio" name="payment_method" value="new" checked>
                        </label>

                        <fieldset id="new-payment-fields" style="margin-top:1em;">
                            <legend>New Payment Method</legend>
                            <div class="form-group">
                                <label for="payment_card_name">Name on Card</label>
                                <input type="text" id="payment_card_name" placeholder="Input Name on Card">
                            </div>
                            <div class="form-group">
                                <label for="payment_card_number">Card Number</label>
                                <input type="text" id="payment_card_number" placeholder="1111-2222-3333-4444">
                            </div>
                            <div class="form-group">
                                <label for="payment_expiry">Expiry Date</label>
                                <input type="text" id="payment_expiry" placeholder="MM/YY">
                            </div>
                            <div class="form-group">
                                <label for="payment_cvv">CVV</label>
                                <input type="text" id="payment_cvv" placeholder="123">
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" id="save_new_payment">
                                    Save this payment method for future?
                                </label>
                            </div>
                        </fieldset>
                    @endif

                    <button type="button" class="next-section" data-next="shipping-options-section">Next</button>
                    <button type="button" class="back-section" data-back="shipping-info-section">Back</button>
                </fieldset>
            </form>
        </section>

        <!-- Shipping Method Section -->
        <section class="checkout-section" id="shipping-options-section" style="display:none;">
            <h2>Shipping Options</h2>
            <form id="shipping-options-form">
                <fieldset>
                    <legend>Select Delivery Method</legend>
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
                    <button type="button" class="next-section" data-next="discount-section">Next</button>
                    <button type="button" class="back-section" data-back="payment-method-section">Back</button>
                </fieldset>
            </form>
        </section>

        <!-- Discount Code Section -->
        <section class="checkout-section" id="discount-section" style="display:none;">
            <h2>Discount Code</h2>
            <form id="discount-form">
                <fieldset>
                    <legend>Apply Discount</legend>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="apply-discount">
                            Apply Discount Code?
                        </label>
                    </div>
                    <div class="form-group" id="discount-code-field" style="display:none;">
                        <label for="discount_code">Discount Code</label>
                        <input type="text" id="discount_code" placeholder="Enter discount code">
                    </div>
                    <button type="button" class="next-section" data-next="order-summary-section">Next</button>
                    <button type="button" class="back-section" data-back="shipping-options-section">Back</button>
                </fieldset>
            </form>
        </section>

        <!-- Order Summary Section -->
        <section class="checkout-section" id="order-summary-section" style="display:none;">
            <form id="order-form" method="POST" action="{{ route('checkout.checkout') }}">
                @csrf
                <h2>Order Summary</h2>
                <ul id="order-items">
                    @php($total = 0)
                    @foreach($basketItems as $basketItem)
                        @php($total += $basketItem->getTotalPrice())
                        <li class="order-item">
                            {{ $basketItem->product->name }}:
                            £{{ number_format($basketItem->product->price,2) }} x {{ $basketItem->quantity }}
                        </li>
                    @endforeach
                </ul>
                <p class="total">Subtotal: £<span id="subtotal-price">{{ number_format($total, 2) }}</span></p>
                <p class="total">Shipping: £<span id="shipping-price">0.00</span></p>
                <p class="total">Discount: -£<span id="discount-amount">0.00</span></p>
                <p class="total">Grand Total: £<span id="grand-total">0.00</span></p>

                <input type="hidden" name="shipping_address" id="shipping_address_hidden">
                <input type="hidden" name="shipping_full_name" id="shipping_full_name_hidden">
                <input type="hidden" name="shipping_address_line1" id="shipping_address_line1_hidden">
                <input type="hidden" name="shipping_city" id="shipping_city_hidden">
                <input type="hidden" name="shipping_post_code" id="shipping_post_code_hidden">
                <input type="hidden" name="shipping_phone" id="shipping_phone_hidden">
                <input type="hidden" name="save_new_address" id="save_new_address_hidden">
                <!--
                <input type="hidden" name="same_as_shipping" id="same_as_shipping_hidden">
                <input type="hidden" name="billing_full_name" id="billing_full_name_hidden">
                <input type="hidden" name="billing_address" id="billing_address_hidden">
                <input type="hidden" name="billing_city" id="billing_city_hidden">
                <input type="hidden" name="billing_postcode" id="billing_postcode_hidden">
                -->
                <input type="hidden" name="payment_method" id="payment_method_hidden">
                <input type="hidden" name="payment_card_name" id="payment_card_name_hidden">
                <input type="hidden" name="payment_card_number" id="payment_card_number_hidden">
                <input type="hidden" name="payment_expiry" id="payment_expiry_hidden">
                <input type="hidden" name="payment_cvv" id="payment_cvv_hidden">
                <input type="hidden" name="save_new_payment" id="save_new_payment_hidden">
                <input type="hidden" name="shipping_option" id="shipping_option_hidden">
                <input type="hidden" name="apply_discount" id="apply_discount_hidden">
                <input type="hidden" name="discount_code" id="discount_code_hidden">

                <button type="submit">Place Order</button>
                <button type="button" class="back-section" data-back="discount-section">Back</button>
            </form>
        </section>

        <!-- success page -->
        <section id="order-success" style="display: none;">
            <h2>Order Placed Successfully!</h2>
            <p>Your order has been successfully placed. Thank you for shopping with us!</p>
        </section>
    </div>
</div>
@endsection
