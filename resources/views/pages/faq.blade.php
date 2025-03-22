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
                <div class="faq-answer">We offer sizes ranging from XS to XXL.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">What payment methods do we Accept? <span class="arrow">▼</span></button>
                <div class="faq-answer">At the current moment we only accept the major credit and debit cards, Plans for
                    Paypal, apple pay, google pay are in the works as well as other apps to help with Payments like
                    Klarna.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">What should i do if i recieve a damaged or incorrect item? <span
                        class="arrow">▼</span></button>
                <div class="faq-answer">Notify us either through email or though our socials and we will help you, you
                    will need to return the item and we will either provide a full refund or we will ship the product
                    you purchased back to you once again.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">What is your return policy? <span class="arrow">▼</span></button>
                <div class="faq-answer">You can return items within 30 days of purchase as long as they are unworn and
                    in original condition. More information relating to returns can be found below.<br><a id="button-link"
                        href="/delivery-and-returns">Delivery and Returns</a></div>
            </div>

            <div class="faq-item">
                <button class="faq-question">Do you ship internationally? <span class="arrow">▼</span></button>
                <div class="faq-answer">At this curretn moment we do not ship oversees and only in the United Kingdom,
                    in the future we plan on shipping globally. Below you can find our Delivery and Returns.<br><a id="button-link"
                        href="/delivery-and-returns">Delivery and Returns</a></div>
            </div>

            <div class="faq-item">
                <button class="faq-question">How long do products take to get to me? <span
                        class="arrow">▼</span></button>
                <div class="faq-answer">When purchasing you have a choise of either 3-5 working days, next day delivery
                    or chosen day. More information relating to shipping can be found below.<br><a id="button-link"
                        href="/delivery-and-returns">Delivery and Returns</a></div>
            </div>

            <div class="faq-item">
                <button class="faq-question">Do you offer discounts or promotions<span class="arrow">▼</span></button>
                <div class="faq-answer">Yes we do we offer students a discount and on occassion we drop discount codes
                    through email and on our socials so check out our socials and add our email to recieve promo
                    codes.<br>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">How can all the sizes be available? <span class="arrow">▼</span></button>
                <div class="faq-answer">
                    All of the clothing items at SportsWear are stocked in their largest size. Upon the item being ordered they are adjusted down to fit whichever size is required. This means that being able to buy an item is not dependent on which size you require. This also reduces waste in unsold units, therefore helping us to run a more sustainable business.
                    <br>
                </div>
            </div>

        </div>

        <div class=" FMI">
            <h2>If This Has Not Helped</h2>
            <p>If this page has not answered your question you can always drop us an Email or use our contact page to
                get in touch.</p>
            <a id="button-link" href="/contact">Contact Us</a>
            <h2>You can also check out our socials as we also listen here.</h2>
            <ul>
                <li><a href="https://www.facebook.com/"><img src="images/Facebook.png" alt="Facebook"></a></li>
                <li><a href="https://www.instagram.com/"><img src="images/Insta.png" alt="Instagram"></a></li>
                <li><a href="https://twitter.com/"><img src="images/x.png" alt="Twitter"></a></li>
                <li><a href="https://www.linkedin.com/"><img src="images/linkedIn.png" alt="LinkedIn"></a></li>
            </ul>
        </div>
    </div>
    </div>
@endsection
