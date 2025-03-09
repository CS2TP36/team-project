@extends('layouts.page')
@section('title','Edit Address')
@section('content')

<div class = "Edit-Address">
    <div class= "container">
        <h2> Edit Address </h2>
        <form id = "editAddressForm">

        <label for ="full_Name">FULL NAME (first & last)</label>
                <input type = "text" id="full_Name"name="full_Name"placeholder="Enter your name" required>
            
            <label for ="phone_Number">PHONENUMBER</label>
                <input type = "text" id="phone_Number" name="phone_Number"placeholder= "Enter your Phone number" required>

            <label for ="post_Code">POSTCODE</label> 
                <input type = "text" id="post_Code"name="post_Code"placeholder = " Enter your PostCode" required>

            <label for ="address_Line1">ADDRESSLINE1 (Company Name)</label>
                <input type = "text"id="address_Line1"name="address_Line1" placeholder = "Enter your Address line" required>
            
            <label for ="address_Line2">ADDRESSLINE2 (Optional)</label>
                <input type = "text"id="address_Line2"name="address_Line2" placeholder = "Enter your Address line ">

            <label for ="town_City">TOWN/CITY</label>
                <input type = "text"id="town_City"name="town_City" placeholder = "Enter your Town/City" required>

            <label for ="county">COUNTY (If Applicable)</label> 
                <input type = "text"id="county"name="county" placeholder = "Enter your County">

            <div class = "checkbox-container">
                <input type = "checkbox" id = "default" name="default">
                <label for= "default"> Set As Default Address </label> 
            </div>
            <button type="submit" class="btn save"> Save Changes </button>
            <button type = "button" class="btn cancel"onclick = "cancelEdit()">Cancel</button>


        </form>
    </div>
</div>


@endsection 



            


                