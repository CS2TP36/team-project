@extends('layouts.page')
@section('title', 'New Address')
@section('content')
<div class="new-address-container">
    <form class="address-form">
        <h2>Add a New Address</h2>

        <label for="full-name">Full Name</label>
        <input type="text" id="full-name" placeholder="Enter your full name" required>

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" placeholder="Enter your phone number" required>

        <label for="postcode">Postcode</label>
        <input type="text" id="postcode" placeholder="Enter your postcode" required>

        <label for="address-line1">Address Line 1</label>
        <input type="text" id="address-line1" placeholder="Street address, P.O. box, company name" required>

        <label for="address-line2">Address Line 2 (Optional)</label>
        <input type="text" id="address-line2" placeholder="Apartment, suite, unit, building, floor">

        <label for="city">Town/City</label>
        <input type="text" id="city" placeholder="Enter your city" required>

        <div class="checkbox-container">
            <label for="default-address">
                <input type="checkbox" id="default-address">
                Make this my default address
            </label>
        </div>
        <button type="submit">Add Address</button>
    </form>
</div>

@endsection