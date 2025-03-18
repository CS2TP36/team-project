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

<script>
    function validateForm() {
        let valid = true;

        // Validates Card Number (Must be 16 digits)
        let cardNumber = document.getElementById("cardNumber").value;
        let cardNumberError = document.getElementById("cardNumberError");
        if (!/^\d{16}$/.test(cardNumber)) {
            cardNumberError.innerText = "Card number must be 16 digits.";
            valid = false;
        } else {
            cardNumberError.innerText = "";
        }

        // Validates Entered Name - checks if there are at least 2 words
        let cardName = document.getElementById("cardName").value;
        let cardNameError = document.getElementById("cardNameError");
        if (cardName.trim() === "") {
            cardNameError.innerText = "Cardholder name is required.";
            valid = false;
        } else {
            cardNameError.innerText = "";
        }

        // Validates Card Expiry Date
        let expiryMonth = document.getElementById("expiryMonth").value;
        let expiryYear = document.getElementById("expiryYear").value;
        let expiryDateError = document.getElementById("expiryDateError");
        let currentYear = new Date().getFullYear() % 100;
        let currentMonth = new Date().getMonth() + 1;

        if (
            !/^\d{2}$/.test(expiryMonth) || 
            !/^\d{2}$/.test(expiryYear) ||
            expiryMonth < 1 || expiryMonth > 12 ||
            expiryYear < currentYear || (expiryYear == currentYear && expiryMonth < currentMonth)
        ) {
            expiryDateError.innerText = "Enter a valid future expiry date.";
            valid = false;
        } else {
            expiryDateError.innerText = "";
        }

        // Validates CVV
        let cvv = document.getElementById("cardCvc").value;
        let cvvError = document.getElementById("cvvError");
        if (!/^\d{3}$/.test(cvv)) {
            cvvError.innerText = "CVV must be 3 digits.";
            valid = false;
        } else {
            cvvError.innerText = "";
        }

        return valid;
    }
</script>

<style>
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }
</style>
@endsection