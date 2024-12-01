document.addEventListener('DOMContentLoaded', () => {
    // Safely access billing elements
    const billingInfo = {
        region: document.getElementById('region'),
        fullName: document.getElementById('full-name'),
        address: document.getElementById('address'),
        postcode: document.getElementById('postcode'),
        phone: document.getElementById('phone')
    };

    // Safely access payment elements
    const paymentInfo = {
        nameOnCard: document.getElementById('name-on-card'),
        cardNumber: document.getElementById('card-number'),
        expiryDate: document.getElementById('expiry-date'),
        cvv: document.getElementById('cvv')
    };

    // Utility functions for error display
    function displayError(inputElement, message) {
        if (!inputElement) return; // Prevent errors if inputElement is null
        let errorSpan = inputElement.parentElement.querySelector('.error-message');
        if (!errorSpan) {
            errorSpan = document.createElement('span');
            errorSpan.className = 'error-message';
            inputElement.parentElement.appendChild(errorSpan);
        }
        errorSpan.textContent = message;
        inputElement.classList.add('error');
    }

    function clearError(inputElement) {
        if (!inputElement) return; // Prevent errors if inputElement is null
        const errorSpan = inputElement.parentElement.querySelector('.error-message');
        if (errorSpan) errorSpan.remove();
        inputElement.classList.remove('error');
    }

    // Validate billing info
    function validateBillingInfo() {
        let isValid = true;

        // Validate each field with null checks
        if (billingInfo.region && !billingInfo.region.value.trim()) {
            displayError(billingInfo.region, "Region is required.");
            isValid = false;
        } else {
            clearError(billingInfo.region);
        }

        if (billingInfo.fullName && !billingInfo.fullName.value.trim()) {
            displayError(billingInfo.fullName, "Full name is required.");
            isValid = false;
        } else {
            clearError(billingInfo.fullName);
        }

        if (billingInfo.address && !billingInfo.address.value.trim()) {
            displayError(billingInfo.address, "Address is required.");
            isValid = false;
        } else {
            clearError(billingInfo.address);
        }

        if (billingInfo.postcode && !billingInfo.postcode.value.trim()) {
            displayError(billingInfo.postcode, "Postcode is required.");
            isValid = false;
        } else {
            clearError(billingInfo.postcode);
        }

        if (billingInfo.phone && !billingInfo.phone.value.trim()) {
            displayError(billingInfo.phone, "Phone number is required.");
            isValid = false;
        } else {
            clearError(billingInfo.phone);
        }

        return isValid;
    }

    // Validate payment info
    function validatePaymentInfo() {
        let isValid = true;

        if (paymentInfo.nameOnCard && !paymentInfo.nameOnCard.value.trim()) {
            displayError(paymentInfo.nameOnCard, "Name on card is required.");
            isValid = false;
        } else {
            clearError(paymentInfo.nameOnCard);
        }

        if (paymentInfo.cardNumber && !paymentInfo.cardNumber.value.trim()) {
            displayError(paymentInfo.cardNumber, "Card number is required.");
            isValid = false;
        } else {
            clearError(paymentInfo.cardNumber);
        }

        if (paymentInfo.expiryDate && !paymentInfo.expiryDate.value.trim()) {
            displayError(paymentInfo.expiryDate, "Expiry date is required.");
            isValid = false;
        } else {
            clearError(paymentInfo.expiryDate);
        }

        if (paymentInfo.cvv && !paymentInfo.cvv.value.trim()) {
            displayError(paymentInfo.cvv, "CVV is required.");
            isValid = false;
        } else {
            clearError(paymentInfo.cvv);
        }

        return isValid;
    }

    // Navigate to the next section
    window.nextSection = (section) => {
        if (section === 'payment') {
            if (validateBillingInfo()) {
                document.getElementById('billing-info-section').style.display = 'none';
                document.getElementById('payment-method-section').style.display = 'block';
            }
        } else if (section === 'summary') {
            if (validatePaymentInfo()) {
                document.getElementById('payment-method-section').style.display = 'none';
                document.getElementById('order-summary-section').style.display = 'block';
            }
        }
    };

    // Navigate back to the payment section
    window.backToPayment = () => {
        document.getElementById('order-summary-section').style.display = 'none';
        document.getElementById('payment-method-section').style.display = 'block';
    };
});
