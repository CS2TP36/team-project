@extends('layouts.page')
@section('title', 'Your Addresses')
@section('content')

    <div class="account-address-payment">
        <h1>Your Addresses</h1>

        <!-- card to add an address -->
        <div class="addresses-payments">
            <a href="{{ route('address.create') }}" class="add">+ Add Address</a>

            @if(isset($addresses) && $addresses->isNotEmpty())
                @foreach($addresses as $address)
                    <div class="card">
                        <strong>
                            {{ $address->full_name }}
                        </strong>
                        <p>
                            {{ $address->address_line1 }}<br>
                            @if($address->address_line2)
                                {{ $address->address_line2 }}<br>
                            @endif
                            {{ $address->town_city }}, {{ $address->post_code }}<br>
                            {{ $address->country }}<br>
                            Phone: {{ $address->phone_number }}
                        </p>

                        <!-- links -->
                        <div class="actions">
                            <a href="{{ route('address.edit', $address->id) }}">Edit</a> |
                            <form action="{{ route('address.destroy', $address->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure?')) this.closest('form').submit();">Remove</a>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- If no addresses exist -->
                <p>No addresses found.</p>
            @endif
        </div>
    </div>

@endsection
