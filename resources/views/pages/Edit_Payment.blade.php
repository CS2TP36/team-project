@extends('layouts.page')
@section('title', 'Edit Payment')
@section('content')
<div class="edit-payment-container">
    <h2>Edit Payment Information</h2>
    <form id="paymentForm">
        
        <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <input type="text" id="cardNumber" name="card_number" placeholder="Enter card number" required>
        </div>

        <div class="form-group">
            <label for="cardName">Cardholder Name</label>
            <input type="text" id="cardName" name="card_name" placeholder="Name on card" required>
        </div>

        <div class="form-group">
            <label for="expiryDate">Expiry Date</label>
            <input type="month" id="expiryDate" name="expiry_date" required>
        </div>

        <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="password" id="cvv" name="cvv" placeholder="CVV" required>
        </div>

        <button type="submit" class="btn">Update Payment</button>
    </form>
</div>
@endsection
