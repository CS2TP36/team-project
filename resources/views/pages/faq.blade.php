@extends('layouts.page')
@section('title','FAQ')
@section('script')
    {{ asset('/js/faq.js') }}
@endsection
@section('content')
<div class="FAQ">
    <h1>Frequently Asked Questions</h1>
    <h2 class="disclaimer fade-in">Here you will find the Most asked questions and Some general Insight</h2>
    
    <div class="faq-container">

        <div class="faq-item">
            <button class="faq-question">What sizes do you offer? <span class="arrow">▼</span></button>
            <div class="faq-answer">We offer sizes ranging from XS to XXL. Check our size guide for exact measurements.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">What payment methods do we Accept? <span class="arrow">▼</span></button>
            <div class="faq-answer">At the current moment we only accept the major credit and debit cards, Plans for Paypal, apple pay, google pay are in the works as well as other apps to help with Payments like Klarna.</div>
        </div>

        <div class="faq-item">
            <button class="faq-question">What should i do if i recieve a damaged or incorrect item? <span class="arrow">▼</span></button>
            <div class="faq-answer">Notify us either through email or though our socials and we will help you, you will need to return the item and we will either provide a full refund or we will ship the product you purchased back to you once again.</div>
        </div>

        <div class="faq-item">
            <button class="faq-question">What is your return policy? <span class="arrow">▼</span></button>
            <div class="faq-answer">You can return items within 30 days of purchase as long as they are unworn and in original condition. More information relating to returns can be found below</div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Do you ship internationally? <span class="arrow">▼</span></button>
            <div class="faq-answer">At this curretn moment we do not ship oversees and only in the United Kingdom, in the future we plan on shipping globally. Below you can find our shipping Information.</div>
        </div>

        <div class="faq-item">
            <button class="faq-question">How long do products take to get to me? <span class="arrow">▼</span></button>
            <div class="faq-answer">When purchasing you have a choise of either 3-5 working days, next day delivery or chosen day. More information relating to shipping can be found below.</div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Do you offer discounts or promotions<span class="arrow">▼</span></button>
            <div class="faq-answer">Yes we do we offer students a discount and on occassion we drop discount codes through email and on our socials so check out our socials and add our email to recieve promo codes.</div>
        </div>
    </div>
</div>
@endsection