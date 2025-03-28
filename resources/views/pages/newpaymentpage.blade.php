@extends('layouts.page')
@section('title', 'New Payment Method')
@section('script', asset('js/payment-validation.js'))
@section('content')
    <div class="new-payment-container">
        <h1 class="payment-title">Enter New Payment Details</h1>

        <form id="payment-form" action="{{ route('payment.store') }}" method="POST" onsubmit="validatePayment(event)" novalidate>
            @csrf
            <label for="cardNumber" class="payment-label">Card number</label>
            <input
                type="text"
                id="cardNumber"
                name="card_number"
                class="payment-input"
                placeholder="1234 5678 9012 3456"
                minlength="16"
                maxlength="16"
                required
            />
            <small class="error-message" id="cardNumberError"></small>

            <div class="card-logos"><img src='{{ asset("images/payment-icon.png") }}' alt="Accepted Cards"/></div>
            <p class="card-type-text">Accepted credit and debit card types</p>

            <label class="payment-label">Expiry date</label>
            <p class="expiry-example">For example, 10/25</p>

            <div class="expiry-row">
                <div class="expiry-field">
                    <label for="expiryMonth" class="visually-hidden">Month</label>
                    <input
                        type="text"
                        id="expiryMonth"
                        name="expiry_month"
                        class="expiry-input"
                        placeholder="MM"
                        maxlength="2"
                        required
                    />
                </div>

                <div class="expiry-field">
                    <label for="expiryYear" class="visually-hidden">Year</label>
                    <input
                        type="text"
                        id="expiryYear"
                        name="expiry_year"
                        class="expiry-input"
                        placeholder="YY"
                        maxlength="2"
                        required
                    />
                </div>
            </div>
            <small class="error-message" id="expiryDateError"></small>

            <label for="cardName" class="payment-label">Name on card</label>
            <input
                type="text"
                id="cardName"
                name="card_name"
                class="payment-input"
                placeholder="Full Name"
                required
            />
            <small class="error-message" id="cardNameError"></small>

            <label for="cardCvc" class="payment-label">Card security code</label>
            <p class="cvc-info">The last 3 or 4 digits on the back of the card</p>
            <input
                type="text"
                id="cardCvc"
                name="card_cvc"
                class="payment-input cvc-input"
                placeholder="123"
                minlength="3"
                maxlength="3"
                required
            />
            <small class="error-message" id="cardCvcError"></small>

            <div class="button-wrapper">
                <button type="submit" class="changes-submit-btn">Submit Changes</button>
            </div>
        </form>
    </div>
@endsection
