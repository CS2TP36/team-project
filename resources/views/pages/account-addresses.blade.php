@extends('layouts.page')

@section('title', 'Your Addresses')

@section('content')
<div class="accountaddresses">
    <h1>Your Addresses</h1>

    <div class="addresses">
        @if(isset($addresses) && $addresses->isNotEmpty())
            @foreach($addresses as $address)
                <div class="address-card">
                    <strong>
                        {{ $address->full_name }}
                        @if($address->is_default || (!$addresses->where('is_default', true)->count() && $loop->first))
                            (Default)
                        @endif
                    </strong>
                    <p>
                        {{ $address->address_line1 }}<br>
                        @if($address->address_line2)
                            {{ $address->address_line2 }}<br>
                        @endif
                        {{ $address->town_city }}, {{ $address->post_code }}<br>
                        @if($address->county)
                            {{ $address->county }}<br>
                        @endif
                        Phone: {{ $address->phone_number }}
                    </p>

                    <div class="address-actions">
                        <a href="{{ route('address.edit', $address->id) }}">Edit</a>
                        |
                        <form action="{{ route('address.destroy', $address->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p>No addresses found. <a href="{{ route('address.create') }}">Add a new address</a>.</p>
        @endif
    </div>

    <div class="add-new-address">
        <a href="{{ route('address.create') }}" class="btn btn-primary">Add New Address</a>
    </div>
</div>
@endsection