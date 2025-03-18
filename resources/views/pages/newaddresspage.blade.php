@extends('layouts.page')
@section('title', 'New Address')
@section('script', asset('js/newaddress.js'))
@section('content')
<div class="new-address-container">
    <form id="newaddressForm" action="{{ route('address.store') }}" method="POST" novalidate>
        @csrf
        <h2>Add a New Address</h2>
        
        <div class="form-group">
            <label for="full-name">Full Name</label>
            <input type="text" id="full-name" name="full_name" placeholder="Enter your full name" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone_number" placeholder="Enter your phone number" required>
        </div>

        <div class="form-group">
            <label for="postcode">Postcode</label>
            <input type="text" id="postcode" name="post_code" placeholder="Enter your postcode" required>
        </div>

        <div class="form-group">
            <label for="address_line1">Address Line 1</label>
            <input type="text" id="addressline1" name="address_line1" placeholder="Street address, P.O. box, company name" required>
        </div>

        <label for="address-line2">Address Line 2 (Optional)</label>
        <input type="text" id="address-line2" name="address_line2" placeholder="Apartment, suite, unit, building, floor">

        <div class="form-group">
            <label for="city">Town/City</label>
            <input type="text" id="city" name="town_city" placeholder="Enter your city" required>
        </div>

        <label for="county">County (Optional)</label>
        <input type="text" id="county" name="county" placeholder="Enter your county">

        <div class="checkbox-container">
            <input type="hidden" name="is_default" value="0">
            <label for="default-address">
                <input type="checkbox" id="default-address" name="is_default" value="1">
                Make this my default address
            </label>
        </div>
        
        <button type="submit">Add Address</button>
    </form>
</div>
@endsection