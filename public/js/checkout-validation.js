document.addEventListener('DOMContentLoaded', () => {
    const billingInfo = {
        region: document.getElementById('region'),
        fullName: document.getElementById('full-name'),
        address: document.getElementById('address'),
        postcode: document.getElementById('postcode'),
        phone: document.getElementById('phone'),
    };

    const paymentInfo = {
        nameOnCard: document.getElementById('card-name'),
        cardNumber: document.getElementById('card-number'),
        expiryDate: document.getElementById('expiry-date'),
        cvv: document.getElementById('cvv'),
    };

    // Map field keys to user-friendly names
    const fieldNames = {
        region: 'Region',
        fullName: 'Full Name',
        address: 'Street Address',
        postcode: 'Postcode',
        phone: 'Phone Number',
        nameOnCard: 'Name on Card',
        cardNumber: 'Card Number',
        expiryDate: 'Expiry Date',
        cvv: 'CVV',
    };

    // Error handling functions
    const displayError = (inputElement, message) => {
        let errorSpan = inputElement.parentElement.querySelector('.error-message');
        if (!errorSpan) {
            errorSpan = document.createElement('span');
            errorSpan.className = 'error-message';
            inputElement.parentElement.appendChild(errorSpan);
        }
        errorSpan.textContent = message;
        inputElement.classList.add('error');
    };

    const clearError = (inputElement) => {
        const errorSpan = inputElement.parentElement.querySelector('.error-message');
        if (errorSpan) errorSpan.remove();
        inputElement.classList.remove('error');
    };

    // Validation functions
    const validateFields = (fields, fieldNames) => {
        let isValid = true;

        for (let key in fields) {
            const field = fields[key];
            const fieldName = fieldNames[key]; // Get the user-friendly field name
            if (!field.value.trim()) {
                displayError(field, `${fieldName} is required.`);
                isValid = false;
            } else {
                clearError(field);
            }

            // Additional validation for expiry date
            if (key === 'expiryDate') {
                const expiryDatePattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
                if (!expiryDatePattern.test(field.value.trim())) {
                    displayError(field, `${fieldName} must be in MM/YY format.`);
                    isValid = false;
                }
            }
        }

        return isValid;
    };

    // Section navigation
    window.nextSection = (sectionId) => {
        const currentSection = document.querySelector('.checkout > section:not([style*="display: none"])');
        let isValid = false;

        if (currentSection.id === 'billing-info-section') {
            isValid = validateFields(billingInfo, fieldNames);
        } else if (currentSection.id === 'payment-method-section') {
            isValid = validateFields(paymentInfo, fieldNames);
        }

        if (isValid) {
            currentSection.style.display = 'none';
            document.getElementById(sectionId).style.display = 'block';
        }
    };

    window.backToSection = (sectionId) => {
        document.querySelectorAll('.checkout > section').forEach((section) => {
            section.style.display = 'none';
        });
        document.getElementById(sectionId).style.display = 'block';
    };

    // Handling the Place Order button
    document.getElementById('place-order-btn').addEventListener('click', (event) => {
        event.preventDefault();

        const allValid =
            validateFields(billingInfo, fieldNames) && validateFields(paymentInfo, fieldNames);

        if (allValid) {
            // Map values to hidden inputs
            const valuesToSend = { ...billingInfo, ...paymentInfo };

            for (let [key, field] of Object.entries(valuesToSend)) {
                const hiddenInput = document.getElementById(`${key}-input`);
                if (hiddenInput) {
                    hiddenInput.value = field.value.trim();
                }
            }

            document.getElementById('order-form').submit();
        } else {
            alert('Please correct the errors before submitting.');
        }
    });
});
