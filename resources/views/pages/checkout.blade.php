@extends('layouts.page')
@use(Illuminate\Support\Facades\Auth)
@use(App\Models\Basket)
@section('title', 'Checkout')
@section('script', 'js/checkout-validation.js')
@section('content')
    <div class="checkout">
        <h1>Checkout</h1>
        @if($errors->any())
            <div id="errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="checkout-container">
        <section class="checkout-section" id="shipping-info-section">
            <h2>Shipping Information</h2>
            <form id="shipping-form">
                <fieldset>
                    <legend>Shipping Details</legend>
                    
                    <!-- A way to to choose a stored address that is on the system on your account-->
                    <div class="form-group">
                        <label>
                            <input type="radio" name="address_choice" value="stored" id="stored-address-radio"> Stored Address
                        </label>
                    </div>
                    
                    <div class="form-group" id="stored-addresses" style="display: none;">
                        <label for="stored_address_id">Select Stored Address</label>
                        <select name="stored_address_id" id="stored_address_id">
                            @if(Auth::check() && Auth::user()->addresses)
                                @foreach(Auth::user()->addresses as $address)
                                    <option value="{{ $address->id }}">{{ $address->address }}, {{ $address->postcode }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Choosing the default address thats on the system on your account-->
                     <div class="form-group">
                        <label>
                            <input type="radio" name="address_choice" value="default" id="default-address-radio"> Use Default Address
                        </label>
                    </div>

                    <div class="form-group" id="default-address" style="display: none;">
                        @if(Auth::check() && Auth::user()->defaultAddress)
                            <p>{{ Auth::user()->defaultAddress->address }}, {{ Auth::user()->defaultAddress->postcode }}</p>
                            <input type="hidden" id="default_address_id" name="default_address_id" value="{{ Auth::user()->defaultAddress->id }}">
                        @else
                           <p>No default address set.</p>
                        @endif
                    </div>
                    
                    <!-- Making a new billing address to ship the items you want to, way to store this new address as well-->
                    <div class="form-group">
                        <label>
                            <input type="radio" name="address_choice" value="new" id="new-address-radio" checked> New Address
                        </label>
                    </div>
                    
                    <div id="new-address-fields">
                        <div class="form-group">
                            <label for="shipping_full_name">Full Name</label>
                            <input type="text" id="shipping_full_name" name="shipping_full_name" placeholder="Input Full Name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="shipping_address_line1">Street Address</label>
                            <input type="text" id="shipping_address_line1" name="shipping_address_line1" placeholder="Street Address e.g 123 blockstone road" required>
                        </div>

                        <div class="form-group">
                            <label for="shipping_city">City</label>
                            <input type="text" id="shipping_city" name="shipping_city" placeholder="City e.g London" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="shipping_post_code">Postcode</label>
                            <input type="text" id="shipping_post_code" name="shipping_post_code" placeholder="Postcode e.g Q23 456" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="shipping_phone">Phone Number</label>
                            <input type="tel" id="shipping_phone" name="shipping_phone" placeholder="Must be a Uk Phone Number, e.g +447000000000" required>
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="save_address" value="1"> Save as Stored Address?
                            </label>
                        </div>
                    </div>
                    <div id="shipping-errors" class="error-message"></div>
                    <button type="button" class="next-section" data-next="payment-method-section">Next</button>
                </fieldset>
            </form>
        </section>
        
        <section class="checkout-section" id="payment-method-section" style="display: none;">
            <h2>Payment Method</h2>
            <form id="payment-form">
                <fieldset>
                    <legend>Payment Details</legend>
                    
                    <!-- A way to to choose a stored payment method that is on the system on your account-->
                    <div class="form-group">
                        <label>
                            <input type="radio" name="payment_choice" value="stored" id="stored-payment-radio"> Use Stored Payment Method
                        </label>
                    </div>
                    
                    <div class="form-group" id="stored-payments" style="display: none;">
                        <label for="stored_payment_id">Select Stored Payment Method</label>
                        <select name="stored_payment_id" id="stored_payment_id">
                            @if(Auth::check() && Auth::user()->paymentMethods)
                               @foreach(Auth::user()->paymentMethods as $paymentMethod)
                                  <option value="{{ $paymentMethod->id }}">Card ending in: {{ substr($paymentMethod->card_number, -4) }}</option>
                               @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <!-- A way to choose the default payment method that is on the system on your account-->
                    <div class="form-group">
                        <label>
                            <input type="radio" name="payment_choice" value="default" id="default-payment-radio"> Use Default Payment Method
                        </label>
                    </div>
                    
                    <div class="form-group" id="default-payment" style="display: none;">
                        @if(Auth::check() && Auth::user()->defaultPaymentMethod)
                            <p>Card ending in: {{ substr(Auth::user()->defaultPaymentMethod->card_number, -4) }}</p>
                            <input type="hidden" id="default_payment_id" name="default_payment_id" value="{{ Auth::user()->defaultPaymentMethod->id }}">
                        @else
                           <p>No default payment method set.</p>
                        @endif
                    </div>
                    
                    <!-- Making a new payment method to pay for  the items you want to, way to store this new payment method as well-->
                    <div class="form-group">
                        <label>
                            <input type="radio" name="payment_choice" value="new" id="new-payment-radio" checked> Use New Payment Method
                        </label>
                    </div>
                    
                    <div id="new-payment-fields">
                        <div class="form-group">
                            <label for="card-name">Name on Card</label>
                            <input type="text" id="card-name" name="card_name" placeholder="Input Name on Card" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="card-number">Card Number</label>
                            <input type="text" id="card-number" name="card_number" placeholder="1111-2222-3333-4444" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="expiry-date">Expiry Date</label>
                            <input type="text" id="expiry-date" name="expiry_date" placeholder="MM/YY" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="123" required>
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="save_payment" value="1"> Save as Stored Payment Method?
                            </label> 
                        </div>
                    </div>
                    
                    <div id="payment-errors" class="error-message"></div>
                    <button type="button" class="next-section" data-next="shipping-options-section">Next</button>
                    <button type="button" class="back-section" data-back="shipping-info-section">Back</button>
                </fieldset>
            </form>
        </section>

        <!-- Choosing a shipping option for when you would like to recieve your items-->
        <section class="checkout-section" id="shipping-options-section" style="display: none;">
            <h2>Shipping options</h2>
            <form id="shipping-options-form">
                <fieldset>
                    <legend>Shipping Options</legend>
                    
                    <div class="form-group">
                        <label>
                            <input type="radio" name="shipping_option" value="standard" required>
                            Standard Delivery: 4-7 days (£4.49)
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label>
                            <input type="radio" name="shipping_option" value="next_day" required>
                            Next Day Delivery: Orders by 7 PM (£6.49)
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="radio" name="shipping_option" value="priority" required>
                            Priority Express Delivery: 2-3 days (£5.49)
                        </label>
                    </div>

                    <div id="shipping-errors" class="error-message"></div>
                    <button type="button" class="next-section" data-next="discount-section">Next</button>
                    <button type="button" class="back-section" data-back="payment-method-section">Back</button>
                </fieldset>
            </form>
        </section>
        
        <!-- If a person has a discount they can apply it here-->
        <section class="checkout-section" id="discount-section" style="display: none;">
            <h2>Discount Code</h2>
            <form id="discount-form">
                <fieldset>
                    <legend>Discount Options</legend>
                    
                    <div class="form-group">
                        <label>
                            <input type="radio" id="no-discount" name="apply_discount" value="no" checked> No Discount?
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="radio" id="apply-discount" name="apply_discount" value="yes"> Apply Discount Code? 
                        </label>
                    </div>

                    <div id="discount-code-input" style="display: none;">
                        <div class="form-group">
                             <label for="discount_code">Discount Code</label>
                             <input type="text" id="discount_code" name="discount_code" placeholder="Enter Discount Code">
                        </div>
                    </div>

                    <div id="discount-errors" class="error-message"></div>
                    <button type="button" class="next-section" data-next="order-summary-section">Next</button>
                    <button type="button" class="back-section" data-back="shipping-info-section">Back</button>
                </fieldset>
            </form>
        </section>

        <!-- Order Summary Section -->
        <section class="checkout-section" id="order-summary-section" style="display:none;">
            <form id="order-form" method="POST" action="{{ route('checkout.checkout') }}">
                @csrf
                <h2>Order Summary</h2>
                <ul id="order-items">
                    @php($total = 0)
                    @foreach($basketItems as $basketItem)
                        @php($total += $basketItem->getTotalPrice())
                        <li class="order-item">
                            {{ $basketItem->product->name }}:
                            £{{ number_format($basketItem->product->price,2) }} x {{ $basketItem->quantity }}
                        </li>
                    @endforeach
                </ul>
                <p class="total">Subtotal: £<span id="subtotal-price">{{ number_format($total, 2) }}</span></p>
                <p class="total">Shipping: £<span id="shipping-price">0.00</span></p>
                <p class="total">Discount: -£<span id="discount-amount">0.00</span></p>
                <p class="total">Grand Total: £<span id="grand-total">0.00</span></p>

                <input type="hidden" name="shipping_address" id="shipping_address_hidden">
                <input type="hidden" name="shipping_full_name" id="shipping_full_name_hidden">
                <input type="hidden" name="shipping_address_line1" id="shipping_address_line1_hidden">
                <input type="hidden" name="shipping_city" id="shipping_city_hidden">
                <input type="hidden" name="shipping_post_code" id="shipping_post_code_hidden">
                <input type="hidden" name="shipping_phone" id="shipping_phone_hidden">
                <input type="hidden" name="save_new_address" id="save_new_address_hidden">
                <input type="hidden" name="same_as_shipping" id="same_as_shipping_hidden">
                <input type="hidden" name="billing_full_name" id="billing_full_name_hidden">
                <input type="hidden" name="billing_address" id="billing_address_hidden">
                <input type="hidden" name="billing_city" id="billing_city_hidden">
                <input type="hidden" name="billing_postcode" id="billing_postcode_hidden">
                <input type="hidden" name="payment_method" id="payment_method_hidden">
                <input type="hidden" name="payment_card_name" id="payment_card_name_hidden">
                <input type="hidden" name="payment_card_number" id="payment_card_number_hidden">
                <input type="hidden" name="payment_expiry" id="payment_expiry_hidden">
                <input type="hidden" name="payment_cvv" id="payment_cvv_hidden">
                <input type="hidden" name="save_new_payment" id="save_new_payment_hidden">
                <input type="hidden" name="shipping_option" id="shipping_option_hidden">
                <input type="hidden" name="apply_discount" id="apply_discount_hidden">
                <input type="hidden" name="discount_code" id="discount_code_hidden">

                <button type="submit">Place Order</button>
                <button type="button" class="back-section" data-back="discount-section">Back</button>
            </form>
        </section>

        <section id="order-success" style="display: none;">
            <h2>Order Placed Successfully!</h2>
            <p>Your order has been successfully placed. Thank you for shopping with us!</p>
        </section>
    </div>
</div>
@endsection
