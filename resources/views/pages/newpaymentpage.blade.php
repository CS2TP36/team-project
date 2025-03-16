@extends('layouts.page')

@section('title', 'New Payment Method')

@section('content')
    <div class="new-payment-container">
        <h1 class="payment-title">Enter New Payment Details</h1>

        <form id="payment-form" action="{{ route('payment.store') }}" method="POST">
            @csrf
            <label for="cardNumber" class="payment-label">Card number</label>
            <input
                type="text"
                id="cardNumber"
                name="card_number"
                class="payment-input"
                placeholder="1234 5678 9012 3456"
                maxlength="19"
                required
            />
            <small class="error-message" id="cardNumberError"></small>

            <div class="card-logos"><img src="images/payment-icon.png" alt="Accepted Cards"/></div>
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
                maxlength="4"
                required
            />
            <small class="error-message" id="cardCvcError"></small>

            <div class="button-wrapper">
                <button type="submit" class="changes-submit-btn">Submit Changes</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('payment-form').addEventListener('submit', function (event) {
            let isValid = true;

            // Validates Card Number (16 digits)
            let cardNumber = document.getElementById('cardNumber').value.replace(/\s+/g, '');
            if (!/^\d{16}$/.test(cardNumber)) {
                document.getElementById('cardNumberError').textContent = "Card number must be 16 digits.";
                isValid = false;
            } else {
                document.getElementById('cardNumberError').textContent = "";
            }

            // Validates Card Expiry Date
            let expiryMonth = parseInt(document.getElementById('expiryMonth').value, 10);
            let expiryYear = parseInt(document.getElementById('expiryYear').value, 10);
            let today = new Date();
            let currentYear = today.getFullYear() % 100; // Last two digits of the year
            let currentMonth = today.getMonth() + 1; 

            if (
                isNaN(expiryMonth) || isNaN(expiryYear) ||
                expiryMonth < 1 || expiryMonth > 12 ||
                (expiryYear < currentYear || (expiryYear === currentYear && expiryMonth < currentMonth))
            ) {
                document.getElementById('expiryDateError').textContent = "Expiry date must be in the future.";
                isValid = false;
            } else {
                document.getElementById('expiryDateError').textContent = "";
            }

            // Validates Entered Name - checks if there are at least 2 words
            let cardName = document.getElementById('cardName').value.trim();
            if (!/^[a-zA-Z]+ [a-zA-Z]+/.test(cardName)) {
                document.getElementById('cardNameError').textContent = "Enter your full name.";
                isValid = false;
            } else {
                document.getElementById('cardNameError').textContent = "";
            }

            // Validates CVV 
            let cardCvc = document.getElementById('cardCvc').value.trim();
            if (!/^\d{3,4}$/.test(cardCvc)) {
                document.getElementById('cardCvcError').textContent = "CVC must be 3 or 4 digits.";
                isValid = false;
            } else {
                document.getElementById('cardCvcError').textContent = "";
            }

            // Prevents form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
@endsection