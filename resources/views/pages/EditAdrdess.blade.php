@extends('layouts.page')
@section('title','Edit Address')
@section('content')
<div class = " Edit- Address ">
    <div class= "container">
        <h2> Edit Address </h2>
        <form id = "editAddressForm">
            <feildFor> FULL NAME (First & Last) </feildFor> 
                <input type = "text" placeholder="Enter your name" required>
            
            <feildFor>PHONE NUMBER</feildFor>
                <input type = "text"placeholder= "Enter your Phone number" required>

            <feildFor> POSTCODE </feildFor>
                <input type = "text" placeholder = " Enter your PostCode" required>

            <feildFor>ADDRESS LINE 1 (Company Name) </feildFor>
                <input type = "text" placeholder = "Enter your Address line" required>
            
            <feildFor> ADDRESS LINE 2 (Optional)</feildFor>
                <input type = "text" placeholder = "Enter your Address line " required>

            <feildFor> TOWN/CITY </feildFor>
                <input type = "text" placeholder = "Enter your Town/City" required>

            <feildFor> COUNTY (If Applicable) </feildFor>
                <input type = "text" placeholder = "Enter your County" required>

            <div class = "checkbox-container">
                <input type = "checkbox" id = "default">
                <feildFor for= "default"> Set As Default Address </feildFor> 
            </div>
            <button type="submit" class="btn save"> Save Changes </button>
            <button type = "button" class="btn cancel"onclick = "cancelEdit()">Cancel</button>
</form>

@endsection 




            


                