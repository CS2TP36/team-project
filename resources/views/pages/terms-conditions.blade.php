@extends('layouts.page')
@section('title', 'Terms and Conditions')
@section('script')
    {{ asset('/js/terms-conditions.js') }}
@endsection
@section('content')
    <div class="terms-container">
        <h1>TERMS AND CONDITIONS</h1>
        <h2 class="disclaimer fade-in">THIS WEBSITE IS NOT REAL, ITS FOR TESTING PURPOSES ANYTHING YOU WILL ORDER OR
            PLACE WILL NOT ARRIVE AND TRANSACTIONS SHOULD NOT BE TAKEN</h2>

        <div class="fade-in">
            <h2>User Agreements</h2>
            <p>By accessing and using this website, you agree to abide by the following terms and conditions: </p>
            <ul>
                <li>You must be at least 18 years old or have the consent of a legal guardian to use this website.</li>
                <li>We reserve the right to update or modify these terms at any time. Changes will take effect
                    immediately upon posting.
                </li>
                <li>Your continued use of the website after any updates constitutes acceptance of the revised terms.
                </li>
                <li>You agree to use this website lawfully and not engage in any activities that may harm, disrupt, or
                    compromise the security of the platform.
                </li>
                <li>We may suspend or terminate access to the website at our discretion if a user is found to be
                    violating these terms.
                </li>
            </ul>
        </div>

        <div class="fade-in">
            <h2>User Account Agreement</h2>
            <p>To access certain features of our website, you may be required to create an account.</p>
            <p>You must provide accurate, complete, and up-to-date information during the registration process.</p>
            <p>You are responsible for maintaining the confidentiality of your account credentials and any activities
                that occur under your account.</p>
            <p>We reserve the right to suspend or terminate accounts that provide false information, violate our terms,
                or engage in fraudulent activities.</p>
            <p>Your account is for personal use only and may not be shared, sold, or transferred to another party.</p>
        </div>

        <div class="fade-in">
            <h2>Product Details and Stock Status</h2>
            <p>We strive to provide accurate descriptions, images, and details for all products listed on our website.
                However, we do not guarantee that all product descriptions, pricing, or images are error-free or
                completely accurate.</p>
            <p>Product availability is subject to change at any time without prior notice. We reserve the right to
                discontinue or limit the quantity of any product..</p>
            <p>In the event of a pricing or inventory error, we reserve the right to cancel or modify an order and will
                notify you of any necessary changes.</p>
            <p>Colors, sizes, and features of products may vary slightly due to differences in display settings,
                manufacturing updates, or other factors.</p>

        </div>

        <div class="fade-in">
            <h2>Purchases and Payments</h2>
            <p>When placing an order on our website, you must ensure that all billing and shipping information provided
                is accurate and up to date.
                Orders are subject to acceptance and availability, and we reserve the right to cancel or refuse any
                order at our discretion, including in cases of suspected fraud,
                pricing errors, or stock limitations. Full payment is required at the time of purchase, and we accept
                debit or credit.</p>
            <p>If a payment is declined or cannot be processed, we may cancel your order without prior notice.
                All prices are displayed in [currency] and may be subject to additional taxes, shipping fees, or other
                applicable charges, which will be calculated at checkout.
                Once an order is confirmed, modifications or cancellations may not be possible, so we advise reviewing
                your order carefully before completing the transaction.</p>
        </div>

        <div class="fade-in">
            <h2>Data Protection Policy</h2>
            <p>We value your privacy and are committed to protecting your personal information. When using our website,
                you may be required to provide certain details such as your name,
                email address, and payment information. This data is collected solely for the purpose of processing
                transactions, improving user experience, and providing customer support.
                We do not sell, trade, or share your personal information with third parties, except as necessary to
                fulfill orders or comply with legal obligations.</p>

            <p>All sensitive information is securely stored and protected using industry-standard security measures.
                However, while we take every precaution to safeguard your data, we cannot guarantee absolute security
                due to the nature of online communications.
                By using our website, you acknowledge and accept the risks associated with transmitting information over
                the internet.</p>
        </div>

        <div class="fade-in">
            <h2>Ownership & Rights</h2>
            <p>All content, including text, images, logos, graphics, and other materials displayed on this website,
                is the exclusive property of SportsWear unless otherwise stated. These materials are protected by
                copyright, trademark, and other intellectual property laws.
                Unauthorized use, reproduction, modification, or distribution of any content from this website without
                prior written consent is strictly prohibited.</p>

            <p>You are granted a limited, non-exclusive, and revocable license to access and use the website for
                personal and non-commercial purposes.
                This license does not permit you to copy, sell, resell, or exploit any part of the website for
                commercial gain. Any unauthorized use may result in legal action.</p>
        </div>

        <div class="fade-in">
            <h2>Unauthorized Activities</h2>
            <p>When using our website, you agree to do so lawfully and ethically. You may not engage in any activity
                that could harm, disrupt,
                or compromise the security and functionality of the platform. This includes, but is not limited to,
                attempting to gain unauthorized access to our systems,
                distributing malicious software, engaging in fraudulent transactions, or interfering with other users'
                experiences.</p>

            <p>Unauthorized commercial use of our website, such as reselling products without permission, scraping
                content, or using automated tools to extract data,
                is strictly prohibited. Additionally, any attempt to misrepresent your identity, impersonate another
                individual or entity, or use the website for illegal,
                abusive, or harassing purposes will result in immediate termination of access.</p>
        </div>

        <div class="fade-in">
            <h2>Limits of Responsibility</h2>
            <p>To the fullest extent permitted by law, SportsWear and its affiliates, officers, directors, employees,
                and agents shall not be liable for any direct,
                indirect, incidental, consequential, or punitive damages arising from your use of this website. This
                includes, but is not limited to, damages resulting from errors,
                interruptions, security breaches, loss of data, or any other issues related to the use or inability to
                use our services.</p>

            <p>We do not guarantee that the website will always function without errors or interruptions, nor do we make
                any warranties regarding the accuracy, reliability,
                or completeness of the content provided. Your use of this website is at your own risk,
                and we shall not be held responsible for any loss or damage resulting from reliance on the information
                or services offered.</p>

            <p>Some jurisdictions may not allow certain limitations of liability, so some of these exclusions may not
                apply to you.
                If you are dissatisfied with any part of our website or these terms, your sole remedy is to discontinue
                use of our services.</p>
        </div>

        <div class="fade-in">
            <h2>Refunds</h2>
            <p>We want you to be satisfied with your purchase. If you are not completely happy with your order, you may
                request a refund under the terms outlined below.
                Refund eligibility is determined based on factors such as product condition, reason for return, and time
                elapsed since the purchase.</p>

            <p>To request a refund, you must contact us at [your contact email] within [number] days of receiving your
                order.
                Items must be returned in their original condition, unused, and with all packaging intact. Certain
                products, such as digital goods, personalized items,
                or perishable goods, may not be eligible for a refund unless they are defective or damaged upon
                arrival..</p>

            <p>Refunds will be processed using the original payment method and may take [number] business days to
                reflect in your account.
                Shipping fees and other associated costs are generally non-refundable unless the return is due to an
                error on our part.
                We reserve the right to deny refund requests that do not meet our policy criteria.</p>

            <p>For more details or to initiate a refund request check out our refund policy page</p>
        </div>

        <div class="fade-in">
            <h2>If this does not Help</h2>
            <p>If you have any questions, check out our FAQ page which may resolve your issue, if not contact us using
                our contact page and will get back to you ASAP.</p>
        </div>
    </div>
@endsection
