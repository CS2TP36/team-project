@extends('layouts.page')
@section('title', 'New Payment Method')
@section('content')
<div class="new-payment-container">
  <h1 class="payment-title">Enter New Payment Details</h1>

  <label for="cardNumber" class="payment-label">Card number</label>
  <input
    type="text"
    id="cardNumber"
    class="payment-input"
    placeholder="1234 5678 9012 3456"
    required
  />


  <div class="card-logos"><img src="images/payment-icon.png" alt="Accepted Cards" /></div>
  <p class="card-type-text">Accepted credit and debit card types</p>

  <label class="payment-label">Expiry date</label>
  <p class="expiry-example">For example, 10/20</p>

  <div class="expiry-row">
    <div class="expiry-field">
      <label for="expiryMonth" class="visually-hidden">Month</label>
      <input
        type="text"
        id="expiryMonth"
        class="expiry-input"
        placeholder="Month"
        maxlength="2"
        required
      />
    </div>

    <div class="expiry-field">
      <label for="expiryYear" class="visually-hidden">Year</label>
      <input
        type="text"
        id="expiryYear"
        class="expiry-input"
        placeholder="Year"
        maxlength="2"
        required
      />
    </div>
  </div>

  <label for="cardName" class="payment-label">Name on card</label>
  <input
    type="text"
    id="cardName"
    class="payment-input"
    placeholder=" Full Name "
    required
  />

  <label for="cardCvc" class="payment-label">Card security code</label>
  <p class="cvc-info">The last 3 digits on the back of the card</p>
  <input
    type="text"
    id="cardCvc"
    class="payment-input cvc-input"
    placeholder="123"
    maxlength="4"
    required
  />

  <div class="button-wrapper">
    <button type="submit" class="changes-submit-btn">Submit Changes</button>
  </div>
  
</div>

@endsection
