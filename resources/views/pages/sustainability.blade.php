@extends('layouts.page')
@section('title','Sponsor')
@section('script', asset('js/contact-details.js'))
@section('content')

    <div class="Sponsership">
        <section>
            <div id="sponsor-banner-container">
                <img src="{{asset('images/Flower.jpg')}}" id="sponsor-banner">
                <div id="sponsor-text-banner">
                </div>
            </div>
        </section>

        <div id=section-divider>
            <p>Sustainability At SportsWear</p>
        </div>

        <!--Gurantee container section-->
        <div id=sustain-gurantee-container>
            <ul id=sustain-guarantee>
                <li id=sustain-guarantee-list><img src="{{asset('images/clothing-icon.png')}}">
                    <h3> Sustainable Materials & Production</h3>At SportsWear we use recycled polyester and organic
                    cotton for our clothing collections, this helps reduce reliance on toxic plastics and harmful
                    pesticides.
                </li>
                <li id=sustain-guarantee-list><img src="{{asset('images/moneys.png')}}">
                    <h3> Circular Economy & Waste Reduction </h3> Our Brands New collection focuses on providing
                    bio-degradable packaging which helps cut down on millions of wasted plastic polybags used every
                    year.
                </li>
                <li id=sustain-guarantee-list><img src="{{asset('images/Carbon-foot.png')}}">
                    <h3> Carbon Footprint & Ethical Supply Chain</h3>At SportsWear we are commited to achievingcarbon
                    neutralitiy, we do this by using maximum renewable energy in our main production facilities and
                    warehouses, hleping reducing the amount of harmful greenhouse gasses produced every year.
                </li>
            </ul>
        </div>

        <!--First sustainability section-->
        <div id=section-divider>
            <p>Our Misson For Sustainability </p>
        </div>

        <div id=sustain-text>
            <p> At SportsWear, sustainability is at the heart of everything that we achieve for. As a leading sports
                fashion retailers, we understand that we have a strong impact on the enviorment and we are willing to
                make a difference about it. We believe that our peformance and sutainability can go hand in hand with
                each other, that is why we always focus on striving to reduce our carbon footprint, use enviromental
                friendly materials for our products, and promote ethical fashion production practises. From making sure
                that we incorporate recycled polyester and organic cotton within our fashion collections, we ensure that
                we reduce waste through innvotative packing solutions. Its is our misson to make sure that we minimise
                our neagtive enviromental impact. We aim to create high quality fashion-wear that not only provides
                optimal performance, but also contributes to providing a healthy planet. By making sure we implement our
                circular economy initiatives, investing in renewable energy, ensuring that we source responsibly. We aim
                to lead the world into a much more sustainable place. We at Sportswear don't just talk aboout change, we
                take action to create a better future for the future generation. </p>
            <img src="{{asset('images/flower-shoe.jpg')}}" id="sustain-pic">
        </div>
        
        <!--Second Sustainability Section-->
        <div id=sustain-second-text>
            <p>Sustainability goes far beyond materials and textiles, it is also about the people who are behind the
                products. That is why we have partnered with ethically certified factories that make sure they provide:
                Fair wages, a safe work enviroment and responsible labour practises. We always work with suppliers who
                meet the Fair Trade standards, making sure that transparency and accoutability is met at every stage of
                the production. By ensuring that me prioritse ethical manufacturing, we are commited to making a
                positive impact on the enviromental world. </p>
            <img src="{{asset('images/factory.jpg')}}" id="sustain-pic">
        </div>

        <!--Third Sustainability Section-->
        <div id=sustain-text>
            <ul id=sustain-list>
                <li><h3> Increase Use of Sustainable Materials</h3>By the end of 2025, We at SportsWear will aim to make
                    sure that all products will be made from recycled, organic or bio-based materials, making sure we
                    reduce our reliance on plastics and other harmful textiles.
                </li>
                <li><h3> Achieve Carbon Neutrality </h3> As of right now we at SportsWear are only 80% to the way being
                    carbon neutral, by the end of 2025 we aim to be fully carbon neutral helping change the enviroment
                    for the better.
                </li>
                <li><h3> Implement a Circular Fashion Program</h3>We will introduce a full scale recycling and resale
                    program, where customers will be allowed to return their old fashion wear for repurposing or
                    recyling it into newer products.
                </li>
            </ul>
            <img src="{{asset('images/2025.jpg')}}" id="sustain-pic">
        </div>
        
        <!--Joining section-->
        <div id="sustain-second-text">
            <p>All of the clothing items at SportsWear are stocked in their largest size. Upon the item being ordered they are adjusted down to fit whichever size is required. This means that being able to buy an item is not dependent on which size you require. This also reduces waste in unsold units, therefore helping us to run a more sustainable business.</p>
            <img src="{{ asset('images/productImage/7db446c4-8537-41b6-a1ee-e7068bfb8bc8.jpg') }}" id = "sustain-pic">
        </div>
    </div>

@endsection
