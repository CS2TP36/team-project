@extends('layouts.page')

@section('title', 'Delivery and Returns')

@section('script')
    <script src="{{ asset('js/delivery-and-returns.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Event listeners for tab buttons
            document.getElementById('tab-delivery').addEventListener('click', function () {
                switchTab('delivery-info', 'tab-delivery');
            });

            document.getElementById('tab-returns').addEventListener('click', function () {
                switchTab('return-info', 'tab-returns');
            });

            function switchTab(sectionId, tabId) {
                // Hide all sections
                document.querySelectorAll('.content-section').forEach(function (section) {
                    section.style.display = 'none';
                });

                // Remove active class from all tabs
                document.querySelectorAll('.tab-btn').forEach(function (tab) {
                    tab.classList.remove('active-tab');
                });

                // Show the selected section and activate the selected tab
                document.getElementById(sectionId).style.display = 'block';
                document.getElementById(tabId).classList.add('active-tab');
            }

            // Initialize with Delivery tab active
            switchTab('delivery-info', 'tab-delivery');
        });
    </script>
@endsection

@section('content')
    <div id="delivery-and-returns">
    <div class="container my-5">
        <h1 class="text-center">Delivery & Returns Information</h1>
        <p class="text-center">Explore our various delivery and return services, designed to cater to your needs
            worldwide.</p>

        <!-- Tabs for Delivery and Returns -->
        <div class="tabs-container text-center my-4">
            <button id="tab-delivery" class="tab-btn active-tab">DELIVERY</button>
            <button id="tab-returns" class="tab-btn">RETURNS</button>
        </div>

        <!-- Delivery Section -->
        <section id="delivery-info" class="content-section">
            <h2>
                <img src="{{ asset('images/delivery-truck.png') }}" alt="Delivery Logo" class="section-icon">
                Delivery Services
            </h2>
            <div class="my-3">

                <ul class="list-group my-4">
                    <li class="list-group-item">
                        <strong>Standard Delivery</strong>: We aim to deliver within 4-7 working days. Cost: £4.49.
                    </li>
                    <li class="list-group-item">
                        <strong>Next Day Delivery</strong>: For quick service, items ordered by 7 PM will arrive the
                        next working day. Cost: £6.49.
                    </li>
                    <li class="list-group-item">
                        <strong>Priority Express Delivery</strong>: Expect delivery within 2-3 business days. Cost:
                        £5.49.
                    </li>
                </ul>

        </section>

        <!-- Returns Section -->
        <section id="return-info" class="content-section" style="display: none;">
            <h2 style="font-size: 2em; margin-bottom: 20px;">
                DO YOU NEED TO RETURN YOUR ORDER?
            </h2>
            <p style="font-size: 1.1em; line-height: 1.8; margin-bottom: 20px;">
                We acknowledge that things don't always go as planned. For your convenience, we have made our returns
                procedure easy and hassle-free.
                <br><br>
                <strong>Returns Procedure:</strong> Only the postal service is used to handle returns. The return
                details are with your package.
                For help, you can also get in touch with us directly.
                <br><br>
                <strong>Call Us:</strong><br>
                Contact: 0121 898 919<br>
                Email: <a href="mailto:support@thesportswear.website">support@thesportswear.website</a>
                <br><br>
                <strong>Return Policy:</strong> Any item may be returned within 28 days of order receipt.
                <br><br>
                Only the postal service is used to handle returns. The return details are with your box. For help, you
                can also get in touch with us directly.
                <br><br>
                <strong>Refunds:</strong> Following processing, refunds may take up to three to five business days to
                show up on your original payment method.
                <br><br>
                <strong>Important:</strong> The products need to be in their original packing and condition.
            </p>
        </section>
    </div>
@endsection


