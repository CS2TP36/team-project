@extends('layouts.page')

@section('title', 'New Address')

@section('content')
<div class="new-address-container">
    <form class="address-form" action="{{ route('address.store') }}" method="POST">
        @csrf
        <h2>Add a New Address</h2>

        <label for="full-name">Full Name</label>
        <input type="text" id="full-name" name="full_name" placeholder="Enter your full name" required>

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone_number" placeholder="Enter your phone number" required>

        <label for="postcode">Postcode</label>
        <input type="text" id="postcode" name="post_code" placeholder="Enter your postcode" required>

        <label for="address-line1">Address Line 1</label>
        <input type="text" id="address-line1" name="address_line1" placeholder="Street address, P.O. box, company name" required>

        <label for="address-line2">Address Line 2 (Optional)</label>
        <input type="text" id="address-line2" name="address_line2" placeholder="Apartment, suite, unit, building, floor">

        <label for="city">Town/City</label>
        <input type="text" id="city" name="town_city" placeholder="Enter your city" required>

        <label for="county">County (Optional)</label>
        <input type="text" id="county" name="county" placeholder="Enter your county">

        <div class="checkbox-container">
            <label for="default-address">
                <input type="checkbox" id="default-address" name="is_default">
                Make this my default address
            </label>
        </div>
        
        <button type="submit">Add Address</button>
    </form>
</div>
@endsection