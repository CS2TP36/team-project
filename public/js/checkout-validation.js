document.addEventListener('DOMContentLoaded', () => {
    let valuesToSend = {};

    // Access billing and payment fields
    const billingFields = {
        region: document.getElementById('region'),
        fullName: document.getElementById('full-name'),
        address: document.getElementById('address'),
        postcode: document.getElementById('postcode'),
        phone: document.getElementById('phone'),
    };

    const paymentFields = {
        nameOnCard: document.getElementById('card-name'),
        cardNumber: document.getElementById('card-number'),
        expiryDate: document.getElementById('expiry-date'),
        cvv: document.getElementById('cvv'),
    };

    // Regular expression for MM/YY format validation (expiry date)
    const expiryDatePattern = /^(0[1-9]|1[0-2])\/[0-9]{2}$/;

    // Function to validate individual fields
    const validateFields = (fields) => {
        let isValid = true;
        for (let key in fields) {
            const field = fields[key];
            if (!field.value.trim()) {
                field.classList.add('error');
                isValid = false;
            } else {
                field.classList.remove('error');
            }

            // Additional validation for expiry date field (MM/YY format)
            if (key === 'expiryDate' && !expiryDatePattern.test(field.value.trim())) {
                field.classList.add('error');
                isValid = false;
            }
        }
        return isValid;
    };

    // Function to handle section change (Next/Back)
    window.nextSection = (sectionId) => {
        const currentSection = document.querySelector('.checkout > section:not([style*="display: none"])');
        let isValid = false;

        // Validate the current section before moving to the next one
        if (currentSection === document.getElementById('billing-info-section')) {
            isValid = validateFields(billingFields);
        } else if (currentSection === document.getElementById('payment-method-section')) {
            isValid = validateFields(paymentFields);
        }

        // Only move to the next section if valid
        if (isValid) {
            currentSection.style.display = 'none';
            document.getElementById(sectionId).style.display = 'block';
        }
    };

    // Function to handle "Back" button action
    window.backToSection = (sectionId) => {
        document.querySelectorAll('.checkout > section').forEach(section => section.style.display = 'none');
        document.getElementById(sectionId).style.display = 'block';
    };

    // Handling the Place Order button click
    document.getElementById('place-order-btn').addEventListener('click', (event) => {
        event.preventDefault(); // Prevent form submission for validation

        // Copy billing fields values and map to corresponding hidden input IDs
        Object.keys(billingFields).forEach((key) => {
            const value = billingFields[key].value.trim();
            valuesToSend[key] = value;
            
            // Map the billing key to its corresponding hidden input ID
            let hiddenInputId;
            switch (key) {
                case 'region':
                    hiddenInputId = 'region-input';
                    break;
                case 'fullName':
                    hiddenInputId = 'name-input';
                    break;
                case 'address':
                    hiddenInputId = 'address-input';
                    break;
                case 'postcode':
                    hiddenInputId = 'postcode-input';
                    break;
                case 'phone':
                    hiddenInputId = 'phone-input';
                    break;
                default:
                    hiddenInputId = `${key}-input`; // Default pattern if needed
                    break;
            }

            // Update the corresponding hidden input value
            const hiddenInput = document.getElementById(hiddenInputId);
            if (hiddenInput) {
                hiddenInput.value = value;
            } else {
                console.error(`Hidden input not found for key: ${hiddenInputId}`);
            }
        });

        // Copy payment fields values and map to corresponding hidden input IDs
        Object.keys(paymentFields).forEach((key) => {
            const value = paymentFields[key].value.trim();
            valuesToSend[key] = value;

            // Map the payment key to its corresponding hidden input ID
            let hiddenInputId;
            switch (key) {
                case 'nameOnCard':
                    hiddenInputId = 'card-name-input';
                    break;
                case 'cardNumber':
                    hiddenInputId = 'card-number-input';
                    break;
                case 'expiryDate':
                    hiddenInputId = 'expiry-date-input';
                    break;
                case 'cvv':
                    hiddenInputId = 'cvv-input';
                    break;
                default:
                    hiddenInputId = `${key}-input`; // Default pattern if needed
                    break;
            }

            // Update the corresponding hidden input value
            const hiddenInput = document.getElementById(hiddenInputId);
            if (hiddenInput) {
                hiddenInput.value = value;
            } else {
                console.error(`Hidden input not found for key: ${hiddenInputId}`);
            }
        });

        // Validate all fields before submitting
        const allValid = validateFields(billingFields) && validateFields(paymentFields);
        if (allValid) {
            // If valid, submit the order form
            document.getElementById('order-form').submit();
        } else {
            // Optionally, show a message to the user that some fields are missing
            alert('Please complete all required fields before submitting.');
        }
    });
});
