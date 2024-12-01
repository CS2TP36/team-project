

let billingInfo = {
    region: document.getElementById('region'),
    fullName: document.getElementById('full-name'),
    address: document.getElementById('address'),
    postcode: document.getElementById('postcode'),
    phone: document.getElementById('phone')
};

let paymentInfo = {
    nameOnCard: document.getElementById('name-on-card'),
    cardNumber: document.getElementById('card-number'),
    expiryDate: document.getElementById('expiry-date'),
    cvv: document.getElementById('cvv')
};

function displayError(inputElement, message) {
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
    const errorSpan = inputElement.parentElement.querySelector('.error-message');
    if (errorSpan) errorSpan.remove();
    inputElement.classList.remove('error');
}

function validateBillingInfo() {
    let isValid = true;

    // Validate Region
    if (!billingInfo.region || !billingInfo.region.value) {
        displayError(billingInfo.region, "Region is required.");
        isValid = false;
    } else {
        clearError(billingInfo.region);
    }

    // Validate Full Name
    if (!billingInfo.fullName || !billingInfo.fullName.value.trim()) {
        displayError(billingInfo.fullName, "Full name is required.");
        isValid = false;
    } else {
        clearError(billingInfo.fullName);
    }

    // Validate Address
    if (!billingInfo.address || !billingInfo.address.value.trim()) {
        displayError(billingInfo.address, "Street address is required.");
        isValid = false;
    } else {
        clearError(billingInfo.address);
    }

    // Validate Postcode
    if (!billingInfo.postcode || !billingInfo.postcode.value.trim()) {
        displayError(billingInfo.postcode, "Postcode is required.");
        isValid = false;
    } else {
        clearError(billingInfo.postcode);
    }

    // Validate Phone Number
    if (!billingInfo.phone || !billingInfo.phone.value.trim()) {
        displayError(billingInfo.phone, "Phone number is required.");
        isValid = false;
    } else {
        clearError(billingInfo.phone);
    }

    return isValid;
}


function validatePaymentInfo() {
    let isValid = true;

    // Validate Name on Card
    if (!paymentInfo.nameOnCard.value.trim()) {
        displayError(paymentInfo.nameOnCard, "Name on card is required.");
        isValid = false;
    } else {
        clearError(paymentInfo.nameOnCard);
    }

    // Validate Card Number
    if (!paymentInfo.cardNumber.value.trim()) {
        displayError(paymentInfo.cardNumber, "Card number is required.");
        isValid = false;
    } else {
        clearError(paymentInfo.cardNumber);
    }

    // Validate Expiry Date
    if (!paymentInfo.expiryDate.value.trim()) {
        displayError(paymentInfo.expiryDate, "Expiry date is required.");
        isValid = false;
    } else {
        clearError(paymentInfo.expiryDate);
    }

    // Validate CVV
    if (!paymentInfo.cvv.value.trim()) {
        displayError(paymentInfo.cvv, "CVV is required.");
        isValid = false;
    } else {
        clearError(paymentInfo.cvv);
    }

    return isValid;
}

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

function backToPayment() {
    document.getElementById('order-summary-section').style.display = 'none';
    document.getElementById('payment-method-section').style.display = 'block';
}