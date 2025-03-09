@extends('layouts.page')
@section('title', 'Your Addresses')
@section('content')

<div class="accountaddresses">
    <h1>Your Addresses</h1>
        
        <!-- card to add an address -->
        <div class="addresses">
            <div class="add-address">+ Add Address</div> 

            
            <!-- dummy data for first card -->
            <div class="address-card">   
                <strong>Ashfaq Choudhury</strong>
                <p>
                    Aston St <br> Birmingham, B4 7ET <br> United Kingdom <br> Phone: 0121 204 3000
                </p>
                
                <!-- links -->
                <div class="actions">
                    <a href="">Edit</a> | <a href="">Remove</a>
                </div>
            </div>

           <!-- dummy data for second card -->
            <div class="address-card"> 
             <strong>John Smith</strong>
                <p>Aston St <br> Birmingham, B4 7ET <br> United Kingdom <br> Phone: 0121 204 3000</p>
                
            <!-- links -->
                <div class="actions">
                    <a href="">Edit</a> | <a href="">Remove</a>
                </div>
            
            </div>
        </div>
    </div>
</div>

@endsection




    


