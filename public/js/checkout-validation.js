document.addEventListener('DOMContentLoaded', function () {
    // Collect billing info elements safely
    const billingInfo = {
        region: document.getElementById('region'),
        fullName: document.getElementById('full-name'),
        address: document.getElementById('address'),
        postcode: document.getElementById('postcode'),
        phone: document.getElementById('phone')
    };

    // Debugging: Verify all elements
    console.log('Billing Info Elements:', billingInfo);

    // Validate Billing Info
    function validateBillingInfo() {
        let isValid = true;

        // Check if each element exists before accessing `value`
        if (!billingInfo.region || !billingInfo.region.value) {
            displayError(billingInfo.region, "Region is required.");
            isValid = false;
        }

        if (!billingInfo.fullName || !billingInfo.fullName.value.trim()) {
            displayError(billingInfo.fullName, "Full name is required.");
            isValid = false;
        }

        if (!billingInfo.address || !billingInfo.address.value.trim()) {
            displayError(billingInfo.address, "Address is required.");
            isValid = false;
        }

        if (!billingInfo.postcode || !billingInfo.postcode.value.trim()) {
            displayError(billingInfo.postcode, "Postcode is required.");
            isValid = false;
        }

        if (!billingInfo.phone || !billingInfo.phone.value.trim()) {
            displayError(billingInfo.phone, "Phone number is required.");
            isValid = false;
        }

        return isValid;
    }

    // Example function to display errors (add your own implementation)
    function displayError(element, message) {
        if (element) {
            console.error(`Error on ${element.id || 'unknown element'}: ${message}`);
            // Highlight the element or show a message (e.g., by appending an error span)
        }
    }

    // Hook to validate on button click (adjust the selector for your button)
    const submitButton = document.querySelector('#submit-button');
    if (submitButton) {
        submitButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default form submission
            if (validateBillingInfo()) {
                console.log('Billing Info is valid. Proceeding...');
                // Proceed with form submission or further logic
            } else {
                console.warn('Validation failed. Fix errors before proceeding.');
            }
        });
    } else {
        console.warn('Submit button not found!');
    }
});
