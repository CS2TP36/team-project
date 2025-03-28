@extends('layouts.page')
@section('title','Sponsor')
@section('script', asset('js/contact-details.js'))
@section('content')


    <div class="Sponsorship"><!--creates the sponsor class-->
        <section>
            <div id="sponsor-banner-container"><!--creates the banner container-->
                <img src="{{asset('images/sponsorship.jpg')}}" id="sponsor-banner">
                <div id="sponsor-text-banner">
                <p>Sponsorship At SportsWear</p>
                <img src="{{asset('images/logo-contact.png')}}" id="sponsor-logo">
            </div>
        </section>

        <div id=catogery-divider>
            <p> Join our Sponsorship Program</p>
        </div>

        <!--First Sponsor Section-->
    <div class = sponsor-main>
        <div id=sponsor-text>
            <p>Want to Succeed? Want to Achieve you dream? We understand that success is not something that happens in
                isolation, its about building meaninful relationships with eachother that helps elevate everyone who is
                involved. Boost your own career with the helping hand of a company that is dedicated to making sure you
                reach the greatest heights of your career. At Sportswear, we are not only a sports fashion brand, but
                also your partner that wants to see you achieve your dreams. We are commited to empowering all our
                atheletes with the tools, support and opportunites that they require to reach their new heights. When
                you work with us, you dont just get yourself a sponsor- you gain a true ally in our journey together to
                success. So how about it? Lets Create something amazing together! </p>
            <img src="{{asset('images/boxing.jpg')}}" id="sponsor-pic">
        </div>

        <div id=catogery-divider>
            <p> Why Partner With Us?</p>
        </div>

        <!--Parallax Container for Sponsor-->
        <div id="parallax-container">
            <div id="parallax" style="background-image: url({{ asset("images/second-parall.jpeg") }});"></div>
            <div id=sponsor-parallax-info>
                <li><strong>Proven Marketting Success:</strong> With SportsWear you will have a dedicated marketing
                    team, that are commited to providng our atheletes with the greatest opporutnies available.
                </li>
                <br>
                <li><strong>Global Reach & Exposure:</strong> As SportsWear is a growing fashion icon, we have a strong
                    presence over various different countries, with a rapid growing community full of active atheletes
                    and fitness enjoyers.
                </li>
                <br>
                <li><strong>Innovative Products:</strong> Our cutting edge clothing wear designs set us apart, allowing
                    us to deliver execptional performance with unparalleled styl made for comfort.
                </li>
                <br>
                <li><strong>Strong Connections:</strong> Once you have joined our team, as one of our atheletes, you
                    will be able to make strong connections with various different companies you can also utilise to
                    grow yourself.
                </li>
                <br>
            </div>
        </div>




        <div id=catogery-divider>
            <p> Look at What Our Atheletes Say</p>
        </div>




        <!--Sponsor Review Section-->
        <div id=sponsor-review-container>
            <div id=sponsor-text>
                <img src="{{asset('images/tom.jpg')}}" id="athlete-pic">
                <li><strong>Tom: </strong>" Being sponsored by SportsWear has been a game changer for me. Not only do I
                    get top-quality gear, but their support has helped me stay focused and motivated. From marketing to
                    personal coaching, they truly invest in my success. I feel like I'm part of a team, and together,
                    we’re achieving great things!"
                </li>
            </div>

            <div id=sponsor-text>
                <img src="{{asset('images/justina.jpg')}}" id="athlete-pic">
                <li><strong>Justina: </strong>"I never imagined a brand could believe in me as much as SportsWear does.
                    The partnership has elevated my career, offering me opportunities I never thought possible. The
                    clothing is not only stylish but performs incredibly well, and the team behind the brand is so
                    supportive. I feel empowered every day!"
                </li>
            </div>

            <div id=sponsor-text>
                <img src="{{asset('images/brandon.jpg')}}" id="athlete-pic">
                <li><strong>Brandon: </strong>"Joining the SportsWear family has been one of the best decisions I've
                    made. The gear is unmatched in quality, and the brand's commitment to helping athletes reach their
                    potential is evident in everything they do. It's not just about sponsorship; it's about building
                    long-term relationships and growing together."
                </li>
            </div>

            <div id=catogery-divider>
                <p>How to Join Us</p>
            </div>
        </div>

        <!--Sponsor Join Text-->
        <div id=sponsor-join-text>
            <p>If you are interested in exploring sponsorship or investment opportunities with SportsWear, please get in
                touch with us through the following:</p>
            <ul>
                <li><strong>Contact:</strong> support@thesportswear.website</li>
                <li><strong>Phone Number:</strong> 0121 326 1812</li>
            </ul>
        </div>
    </div>



@endsection
