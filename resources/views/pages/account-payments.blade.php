@extends('layouts.page')
@section('title', 'Your Payments')
@section('content')

    <div class="accountpayments">
        <h1>Your Payment Methods</h1>

        <!-- Card to add a new card/payment method -->
        <div class="payments">
            <a href="{{ route('payment.create') }}" class="add-payment">+ Add Payment Method</a>

            <!-- Check if payment methods exist -->
                @if(isset($payments) && $payments->isNotEmpty())
                @foreach($payments as $paymentMethod)
                    <div class="payment-card">
                        <strong>
                            **** **** **** {{ substr($paymentMethod->card_number, -4) }}
                            @if($paymentMethod->is_default) (Default) @endif
                        </strong>
                        <p>
                            {{ $paymentMethod->card_name }} <br>
                            Expiry: {{ str_pad($paymentMethod->expiry_month, 2, '0', STR_PAD_LEFT) }}/{{ $paymentMethod->expiry_year }}
                        </p>

                        <!-- Actions -->
                        <div class="actions">
                            <a href="{{ route('payment.edit', $paymentMethod->id) }}">Edit</a> | 
                            <form action="{{ route('payment.destroy', $paymentMethod->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure?')) this.closest('form').submit();">Remove</a>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No payment methods found.</p>
            @endif
        </div>
    </div>

@endsection