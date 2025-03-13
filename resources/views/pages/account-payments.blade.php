@extends('layouts.page')
@section('title', 'Your Payments')
@section('content')

    <div class="accountpayments">
        <h1>Your Payment Methods</h1>

        <!-- Card to add a new card/payment method -->
        <div class="payments">
            <div class="add-payment"> + Add Payment Method</div>

            <!-- dummy data for first payment card-->
            <div class="payment-card">
                <strong>Visa</strong>
                <p> Ashfaq Choudhury <br> **** **** **** 1234 <br> Exp:12/25
                </p>

                <!-- links -->
                <div class="actions">
                    <a href="">Edit</a> | <a href="">Remove</a>
                </div>
            </div>

            <!-- dummy data for second payment card-->
            <div class="payment-card">
                <strong>MasterCard</strong>
                <p> John Smith <br> **** **** **** 5678 <br> Exp:09/27
                </p>

                <!-- links -->
                <div class="actions">
                    <a href="">Edit</a> | <a href="">Remove</a>
                </div>
            </div>
        </div>

@endsection
