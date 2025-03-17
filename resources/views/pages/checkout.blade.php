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

            <section class="checkout-section" id="shipping-info-section">
                <h2>Shipping Address</h2>
                @foreach ($addresses as $address)
                    <label>
                        <input type="radio" name="shipping_address" value="{{ $address->id }}" required>
                        {{ $address->full_name }}, {{ $address->address_line1 }}, {{ $address->town_city }}, {{ $address->post_code }}
                    </label><br>
                @endforeach
                <button type="button" class="next-section" data-next="billing-info-section">Next</button>
            </section>

            <section class="checkout-section" id="billing-info-section" style="display:none;">
                <h2>Billing Address</h2>
                <label>
                    <input type="checkbox" id="same-as-shipping" name="same_as_shipping" checked>
                    Billing address same as shipping?
                </label>
                <div id="billing-fields" style="display:none;">
                    <input type="text" name="billing_full_name" placeholder="Full Name">
                    <input type="text" name="billing_address" placeholder="Street Address">
                    <input type="text" name="billing_postcode" placeholder="Postcode">
                    <input type="text" name="billing_city" placeholder="City">
                </div>
                <button type="button" class="next-section" data-next="payment-method-section">Next</button>
                <button type="button" class="back-section" data-back="shipping-info-section">Back</button>
            </section>

            <section class="checkout-section" id="payment-method-section" style="display:none;">
                <h2>Payment Method</h2>
                @foreach ($paymentMethods as $payment)
                    <label>
                        <input type="radio" name="payment_method" value="{{ $payment->id }}" required>
                        {{ $payment->card_name }} - **** **** **** {{ substr($payment->card_number, -4) }}
                    </label><br>
                @endforeach
                <button type="button" class="next-section" data-next="order-summary-section">Next</button>
                <button type="button" class="back-section" data-back="billing-info-section">Back</button>
            </section>

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

document.getElementById('same-as-shipping').addEventListener('change', (e) => {
    document.getElementById('billing-fields').style.display = e.target.checked ? 'none' : 'block';
});
</script>
@endsection
