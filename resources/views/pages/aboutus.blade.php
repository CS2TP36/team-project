@extends('layouts.page')
@section('title','About Us')
@section('script')
    {{ asset('/js/about.js') }}
@endsection
@section('content')
    <div class="aboutus">

        <div id="banner-container">
            <div id="overlay"></div>
            <img src="images/About-Pic.png" id="banner" alt="About Us Banner">
            <div id="text-banner">
                </br></br></br>
                <p id="product-text-banner">About SportsWear</p>
            </div>
        </div>


        <!-- About Us Section -->


        <!-- Mission Section -->
        <section class="content-container">
            <img src="images/Mission-.png" class="section-image" alt="Mission Image">
            <div class="text">
                <h2>Our Mission</h2>
                <p>At SportsWear, our mission is to fill the gap in the market for athletic apparel that combines
                    cutting-edge
                    performance, unmatched comfort, and sustainability.
                    We recognized that athletes deserve more than just gear—they need clothing that adapts to their
                    toughest
                    workouts and long hours of wear.
                    Thats why we have carefully engineered our fabrics to offer superior durability, breathability, and
                    flexibility, ensuring you perform at your peak.
                    By prioritizing innovation and ethical manufacturing, we create apparel that not only supports your
                    athletic
                    goals but also helps protect the planet.
                    Our vision is to empower athletes to push beyond their limits with gear that works as hard as they
                    do.
                </p>
            </div>
        </section>

        <section class="content-container">
            <img src="images/About-.png" class="section-image" alt="About Us Image">
            <div class="text">
                <h2>What Can SportsWear Provide?</h2>
                <p>At Sportswear, we are dedicated to providing top-tier athletic gear that combines comfort,
                    durability,
                    and
                    performance.
                    Our goal is to empower athletes of all levels to reach their full potential while looking and
                    feeling
                    their
                    best.
                    We believe that the right gear can further inspire yourself whether you are training hard or pushing
                    your
                    limits on game day.</p>
            </div>
        </section>

        <!-- Sportswear Origin -->
        <section class="content-container">
            <img src="images/Origin.png" class="section-image" alt="Origin Image">
            <div class="text">
                <h2>SportsWear Origin</h2>
                <p>SportsWear was founded in 2024 by a group of passionate athletes, designers, and innovators who saw a
                    gap
                    in the market for athletic apparel that truly met the needs of modern athletes.
                    Frustrated with gear that compromised performance for comfort, and vice versa, we set out to create
                    a
                    brand that could do both. After countless hours of research and collaboration, we developed a line
                    of SportsWear designed not only
                    for peak performance but also for durability, flexibility, and style.</p>

                <p>Driven by a shared commitment to sustainability and quality, we sourced only the best materials and
                    partnered with manufacturers who aligned with our values.
                    From day one, our goal was clear: to provide athletes of all levels with the tools they need to
                    excel while making a positive impact on the world.</p>
            </div>
        </section>

        <!-- What Sets Us Apart -->
        <section class="content-container">
            <img src="images/Unique-.png" class="section-image" alt="Unique Image">
            <div class="text">
                <h2>What Sets Us Apart</h2>
                <p>At SportsWear, we believe in more than just making high-quality gear we’re redefining what athletic
                    apparel
                    should be. Here’s what makes us different:</p>
                <ul>
                    <li>Innovative Materials: We use state-of-the-art fabrics that offer unmatched durability,
                        breathability,
                        and stretch. Unlike other brands, our gear is built to withstand the most intense workouts and
                        long
                        training sessions, all while maintaining comfort and performance.
                    </li>
                    <li>At Our Core: We are committed to minimizing our environmental impact. From eco-friendly
                        production
                        processes to using recycled and biodegradable materials, our focus is on creating apparel that
                        not
                        only
                        performs but also respects the planet.
                    </li>
                    <li>Designed for Every Athlete: Whether you're a professional athlete or just starting your fitness
                        journey,
                        our gear is engineered to fit and perform for all body types and levels of activity. We
                        prioritize
                        inclusivity and functionality in every piece we create.
                    </li>
                    <li>Passion-Driven Innovation: Born out of frustration with the limitations of traditional
                        sportswear,
                        our
                        designs are inspired by athletes for athletes. Our team is constantly pushing the boundaries to
                        develop
                        gear that enhances performance in every way.
                    </li>
                </ul>
            </div>
        </section>

        <!-- Call to Action -->
        <section id="cta">
            <h2>Join the Movement</h2>
            <p>Explore our collection and take your performance to the next level.</p>
            <a id="button-link" href="/products">Shop Now</a>
        </section>
    </div>
@endsection
