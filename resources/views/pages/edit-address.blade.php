@extends('layouts.page')
@section('script', asset('js/edit.js'))
@section('title','Edit Address')
@section('content')
<div class="Edit-Address">
    <div class="container">
        <h2>Edit Address</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="error-messages">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="error-message">
              <p>{{ session('error') }}</p>
            </div>
        @endif

        <form id="editAddressForm"  action="{{ route('address.update', $address->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="full_Name">Full Name (first & last)</label>
              <input type="text" id="full_Name" name="full_name" value="{{ old('full_name', $address->full_name) }}" required>
            </div>

            <div class="form-group">
              <label for="phone_Number">Phone Number</label>
              <input type="text" id="phone_Number" name="phone_number" value="{{ old('phone_number', $address->phone_number) }}" required>
            </div>

            <div class="form-group">
              <label for="post_Code">Post Code</label>
              <input type="text" id="post_Code" name="post_code" value="{{ old('post_code', $address->post_code) }}" required>
            </div>

            <div class="form-group">
              <label for="address_Line1">Address Line 1</label>
              <input type="text" id="address_Line1" name="address_line1" value="{{ old('address_line1', $address->address_line1) }}" required>
            </div>

            <div class="form-group">
              <label for="town_City">Town/City</label>
              <input type="text" id="town_City" name="town_city" value="{{ old('town_city', $address->town_city) }}" required>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="is_default" name="is_default" value="1" {{ old('is_default', $address->is_default) ? 'checked' : '' }}>
                <label for="is_default">Set As Default Address</label>
            </div>

        </form>

        <button id="submit" class="btn save">Save Changes</button>
        <button type="button" class="btn cancel" onclick="window.history.back()">Cancel</button>
    </div>
</div>

@endsection
