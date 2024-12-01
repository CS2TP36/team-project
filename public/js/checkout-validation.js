// Retrieve billing and payment elements safely
let billingInfo = {
    region: document.getElementById('region') || null,
    fullName: document.getElementById('full-name') || null,
    address: document.getElementById('address') || null,
    postcode: document.getElementById('postcode') || null,
    phone: document.getElementById('phone') || null
};

let paymentInfo = {
    nameOnCard: document.getElementById('name-on-card') || null,
    cardNumber: document.getElementById('card-number') || null,
    expiryDate: document.getElementById('expiry-date') || null,
    cvv: document.getElementById('cvv') || null
};

// Display error message
function displayError(inputElement, message) {
    if (!inputElement) return; // Ensure element exists
    let errorSpan = inputElement.parentElement.querySelector('.error-message');
    if (!errorSpan) {
        errorSpan = document.createElement('span');
        errorSpan.className = 'error-message';
        inputElement.parentElement.appendChild(errorSpan);
    }
    errorSpan.textContent = message;
    inputElement.classList.add('error');
}

// Clear error message
function clearError(inputElement) {
    if (!inputElement) return; // Ensure element exists
    const errorSpan = inputElement.parentElement.querySelector('.error-message');
    if (errorSpan) errorSpan.remove();
    inputElement.classList.remove('error');
}

// Validate Billing Info
function validateBillingInfo() {
    let isValid = true;

    // Validate Region
    if (billingInfo.region && !billingInfo.region.value.trim()) {
        displayError(billingInfo.region, "Region is required.");
        isValid = false;
    } else {
        clearError(billingInfo.region);
    }

    // Validate Full Name
    if (billingInfo.fullName && !billingInfo.fullName.value.trim()) {
        displayError(billingInfo.fullName, "Full name is required.");
        isValid = false;
    } else {
        clearError(billingInfo.fullName);
    }

    // Validate Address
    if (billingInfo.address && !billingInfo.address.value.trim()) {
        displayError(billingInfo.address, "Street address is required.");
        isValid = false;
    } else {
        clearError(billingInfo.address);
    }

    // Validate Postcode
    if (billingInfo.postcode && !billingInfo.postcode.value.trim()) {
        displayError(billingInfo.postcode, "Postcode is required.");
        isValid = false;
    } else {
        clearError(billingInfo.postcode);
    }

    // Validate Phone Number
    if (billingInfo.phone && !billingInfo.phone.value.trim()) {
        displayError(billingInfo.phone, "Phone number is required.");
        isValid = false;
    } else {
        clearError(billingInfo.phone);
    }

    return isValid;
}

// Validate Payment Info
function validatePaymentInfo() {
    let isValid = true;

    // Validate Name on Card
    if (paymentInfo.nameOnCard && !paymentInfo.nameOnCard.value.trim()) {
        displayError(paymentInfo.nameOnCard, "Name on card is required.");
        isValid = false;
    } else {
        clearError(paymentInfo.nameOnCard);
    }

    // Validate Card Number
    if (paymentInfo.cardNumber && !paymentInfo.cardNumber.value.trim()) {
        displayError(paymentInfo.cardNumber, "Card number is required.");
        isValid = false;
    } else {
        clearError(paymentInfo.cardNumber);
    }

    // Validate Expiry Date
    if (paymentInfo.expiryDate && !paymentInfo.expiryDate.value.trim()) {
        displayError(paymentInfo.expiryDate, "Expiry date is required.");
        isValid = false;
    } else {
        clearError(paymentInfo.expiryDate);
    }

    // Validate CVV
    if (paymentInfo.cvv && !paymentInfo.cvv.value.trim()) {
        displayError(paymentInfo.cvv, "CVV is required.");
        isValid = false;
    } else {
        clearError(paymentInfo.cvv);
    }

    return isValid;
}

// Navigate to the next section
function nextSection(section) {
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
}

// Navigate back to the payment section
function backToPayment() {
    document.getElementById('order-summary-section').style.display = 'none';
    document.getElementById('payment-method-section').style.display = 'block';
}
