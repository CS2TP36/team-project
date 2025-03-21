@extends('layouts.page')
@section('title', 'Edit Payment')
@section('content')
<div class="edit-payment-container">
    <h1>Edit Payment Information</h1>

    <form action="{{ route('payment.update', $paymentMethod->id) }}" method="POST" onsubmit="return validateForm()">
        @csrf
        @method('PUT')

        <!-- Card Number -->
        <label for="cardNumber">Card Number</label>
        <input type="text" id="cardNumber" name="card_number" value="{{ old('card_number', $paymentMethod->card_number) }}" required>
        <span class="error-message" id="cardNumberError"></span>

        <!-- Cardholder Name -->
        <label for="cardName">Cardholder Name</label>
        <input type="text" id="cardName" name="card_name" value="{{ old('card_name', $paymentMethod->card_name) }}" required>
        <span class="error-message" id="cardNameError"></span>

        <!-- Expiry Date -->
        <label>Expiry Date</label>
        <div>
            <input type="text" id="expiryMonth" name="expiry_month" placeholder="MM" value="{{ old('expiry_month', $paymentMethod->expiry_month) }}" required>
            <input type="text" id="expiryYear" name="expiry_year" placeholder="YY" value="{{ old('expiry_year', $paymentMethod->expiry_year) }}" required>
        </div>
        <span class="error-message" id="expiryDateError"></span>

        <!-- CVV -->
        <label for="cardCvc">CVV</label>
        <input type="text" id="cardCvc" name="cvv" value="{{ old('cvv', $paymentMethod->cvv) }}" required>
        <span class="error-message" id="cvvError"></span>

        <!-- Buttons -->
        <button type="submit">Update Payment</button>
    </form>
</div>
@endsection