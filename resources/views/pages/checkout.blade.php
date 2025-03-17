@extends('layouts.page')

@section('title', 'Checkout')
@section('script', asset('js/checkout-validation.js'))

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
        <form id="order-form" method="POST" action="{{ route('checkout.checkout') }}">
            @csrf

            <!-- SHIPPING ADDRESS SECTION -->
            <section class="checkout-section" id="shipping-info-section">
                <h2>Shipping Address</h2>

                @if($addresses->count() > 0)
                    <!-- List saved addresses -->
                    @foreach ($addresses as $address)
                        <label style="display:block; margin-bottom:0.5em;">
                            <input type="radio" name="shipping_address" value="{{ $address->id }}" required>
                            {{ $address->full_name }}, {{ $address->address_line1 }},
                            {{ $address->town_city }}, {{ $address->post_code }}
                        </label>
                    @endforeach

                    <!-- Option to use a new address -->
                    <label style="display:block; margin-top:1em;">
                        <input type="radio" name="shipping_address" value="new" required>
                        Use a new address
                    </label>

                    <!-- Hidden fields for a new shipping address (initially hidden) -->
                    <div id="new-address-fields" style="display:none; margin-top:1em;">
                        <input type="text" name="shipping_full_name" placeholder="Full Name"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="shipping_address_line1" placeholder="Street Address"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="shipping_city" placeholder="City"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="shipping_post_code" placeholder="Postcode"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="shipping_phone" placeholder="Phone Number"
                               style="display:block; margin-bottom:0.5em;">

                        <label>
                            <input type="checkbox" name="save_new_address" value="1">
                            Save this address for future?
                        </label>
                    </div>
                @else
                    <!-- No saved addresses, always show new address fields -->
                    <p>You have no saved addresses. Please enter a new address below:</p>
                    <input type="hidden" name="shipping_address" value="new">
                    <div id="new-address-fields" style="margin-top:1em;">
                        <input type="text" name="shipping_full_name" placeholder="Full Name"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="shipping_address_line1" placeholder="Street Address"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="shipping_city" placeholder="City"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="shipping_post_code" placeholder="Postcode"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="shipping_phone" placeholder="Phone Number"
                               style="display:block; margin-bottom:0.5em;">

                        <label>
                            <input type="checkbox" name="save_new_address" value="1">
                            Save this address for future?
                        </label>
                    </div>
                @endif

                <button type="button" class="next-section" data-next="billing-info-section" style="margin-top:1em;">
                    Next
                </button>
            </section>

            <!-- BILLING ADDRESS SECTION -->
            <section class="checkout-section" id="billing-info-section" style="display:none;">
                <h2>Billing Address</h2>
                <label>
                    <input type="checkbox" id="same-as-shipping" name="same_as_shipping" checked>
                    Billing address same as shipping?
                </label>
                <div id="billing-fields" style="display:none; margin-top:1em;">
                    <input type="text" name="billing_full_name" placeholder="Full Name"
                           style="display:block; margin-bottom:0.5em;">
                    <input type="text" name="billing_address" placeholder="Street Address"
                           style="display:block; margin-bottom:0.5em;">
                    <input type="text" name="billing_postcode" placeholder="Postcode"
                           style="display:block; margin-bottom:0.5em;">
                    <input type="text" name="billing_city" placeholder="City"
                           style="display:block; margin-bottom:0.5em;">
                </div>
                <button type="button" class="next-section" data-next="payment-method-section">Next</button>
                <button type="button" class="back-section" data-back="shipping-info-section">Back</button>
            </section>

            <!-- PAYMENT METHOD SECTION -->
            <section class="checkout-section" id="payment-method-section" style="display:none;">
                <h2>Payment Method</h2>

                @if($paymentMethods->count() > 0)
                    @foreach ($paymentMethods as $payment)
                        <label style="display:block; margin-bottom:0.5em;">
                            <input type="radio" name="payment_method" value="{{ $payment->id }}" required>
                            {{ $payment->card_name }} - **** **** **** {{ substr($payment->card_number, -4) }}
                        </label>
                    @endforeach

                    <!-- Option to use a new payment method -->
                    <label style="display:block; margin-top:1em;">
                        <input type="radio" name="payment_method" value="new" required>
                        Use a new payment method
                    </label>

                    <!-- Split month/year fields -->
                    <div id="new-payment-fields" style="display:none; margin-top:1em;">
                        <input type="text" name="payment_card_name" placeholder="Name on Card"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="payment_card_number" placeholder="Card Number"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="payment_expiry_month" placeholder="Expiry Month (MM)"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="payment_expiry_year" placeholder="Expiry Year (YY)"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="payment_cvv" placeholder="CVV"
                               style="display:block; margin-bottom:0.5em;">

                        <label>
                            <input type="checkbox" name="save_new_payment" value="1">
                            Save this payment method for future?
                        </label>
                    </div>
                @else
                    <p>No saved payment methods found. Please enter a new method below:</p>
                    <input type="hidden" name="payment_method" value="new">
                    <div id="new-payment-fields" style="margin-top:1em;">
                        <input type="text" name="payment_card_name" placeholder="Name on Card"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="payment_card_number" placeholder="Card Number"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="payment_expiry_month" placeholder="Expiry Month (MM)"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="payment_expiry_year" placeholder="Expiry Year (YY)"
                               style="display:block; margin-bottom:0.5em;">
                        <input type="text" name="payment_cvv" placeholder="CVV"
                               style="display:block; margin-bottom:0.5em;">

                        <label>
                            <input type="checkbox" name="save_new_payment" value="1">
                            Save this payment method for future?
                        </label>
                    </div>
                @endif

                <button type="button" class="next-section" data-next="order-summary-section">Next</button>
                <button type="button" class="back-section" data-back="billing-info-section">Back</button>
            </section>

            <!-- ORDER SUMMARY SECTION -->
            <section class="checkout-section" id="order-summary-section" style="display:none;">
                <h2>Order Summary</h2>
                <ul>
                    @php($total = 0)
                    @foreach($basketItems as $item)
                        <li>{{ $item->product->name }} - £{{ number_format($item->product->price,2) }} x {{ $item->quantity }}</li>
                        @php($total += $item->product->price * $item->quantity)
                    @endforeach
                </ul>
                <p>Total: £{{ number_format($total,2) }}</p>

                <button type="submit">Place Order</button>
                <button type="button" class="back-section" data-back="payment-method-section">Back</button>
            </section>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Next/Back logic
    document.querySelectorAll('.next-section').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.checkout-section').forEach(s => s.style.display = 'none');
            document.getElementById(btn.dataset.next).style.display = 'block';
        });
    });

    document.querySelectorAll('.back-section').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.checkout-section').forEach(s => s.style.display = 'none');
            document.getElementById(btn.dataset.back).style.display = 'block';
        });
    });

    // Toggle billing fields
    const sameAsShipping = document.getElementById('same-as-shipping');
    sameAsShipping.addEventListener('change', (e) => {
        document.getElementById('billing-fields').style.display = e.target.checked ? 'none' : 'block';
    });

    // Toggle new shipping address fields if user has addresses
    @if($addresses->count() > 0)
        const addressRadios = document.querySelectorAll('input[name="shipping_address"]');
        const newAddressFields = document.getElementById('new-address-fields');

        addressRadios.forEach(radio => {
            radio.addEventListener('change', e => {
                if (e.target.value === 'new') {
                    newAddressFields.style.display = 'block';
                } else {
                    newAddressFields.style.display = 'none';
                }
            });
        });
    @endif

    // Toggle new payment method fields if user has methods
    @if($paymentMethods->count() > 0)
        const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
        const newPaymentFields = document.getElementById('new-payment-fields');

        paymentRadios.forEach(radio => {
            radio.addEventListener('change', e => {
                if (e.target.value === 'new') {
                    newPaymentFields.style.display = 'block';
                } else {
                    newPaymentFields.style.display = 'none';
                }
            });
        });
    @endif
});
</script>
@endsection