@extends('layouts.page')

@section('title', 'Your Payment Methods')

@section('content')
<div class="account-payments">
    <h1>Your Payment Methods</h1>

    <div class="payments">
        @if(isset($payments) && $payments->isNotEmpty())
            @foreach($payments as $payment)
                <div class="payment-card">
                    <strong>
                        {{ substr($payment->card_number, 0, 4) }} **** **** ****
                        @if($payment->is_default || (!$payments->where('is_default', true)->count() && $loop->first))
                            (Default)
                        @endif
                    </strong>
                    <p>
                        {{ $payment->card_name }}<br>
                        Expiry: {{ $payment->expiry_month }}/{{ $payment->expiry_year }}
                    </p>

                    <div class="payment-actions">
                        <a href="{{ route('payment.edit', $payment->id) }}">Edit</a> |
                        <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p>No payment methods found.</p>
        @endif
    </div>

    <div class="add-new-payment">
        <a href="{{ route('payment.create') }}" class="btn">Add a new payment method</a>
    </div>
</div>
@endsection