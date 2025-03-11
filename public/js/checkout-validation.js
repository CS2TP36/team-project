document.addEventListener('DOMContentLoaded', () => {
    const billingInfo = {
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

    const shippingInfo = {
        shippingOption: document.querySelector('input[name="shipping_option"]:checked'),
    };

    const discountInfo = {
        applyDiscount: document.getElementById('apply-discount'),
        discountCode: document.getElementById('discount_code'),
    };

    const fieldNames = {
        fullName: 'Full Name',
        address: 'Street Address',
        postcode: 'Postcode',
        phone: 'Phone Number',
        nameOnCard: 'Name on Card',
        cardNumber: 'Card Number',
        expiryDate: 'Expiry Date',
        cvv: 'CVV',
    };

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

    const validateFields = (fields, fieldNames) => {
        let isValid = true;

        for (let key in fields) {
            const field = fields[key];
            const fieldName = fieldNames[key];
            if (!field.value || !field.value.trim()) {
                displayError(field, `${fieldName} is required.`);
                isValid = false;
            } else {
                clearError(field);
            }

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

    const calculateTotal = () => {
        let total = parseFloat(document.getElementById('total-price').textContent.replace(',', ''));
        let shipping = 0;
        let discount = 0;

        const shippingOption = document.querySelector('input[name="shipping_option"]:checked');
        if (shippingOption) {
            if (shippingOption.value === 'standard') shipping = 4.49;
            else if (shippingOption.value === 'next_day') shipping = 6.49;
            else if (shippingOption.value === 'priority') shipping = 5.49;
        }

        document.getElementById('shipping-price').textContent = shipping.toFixed(2);

        if (discountInfo.applyDiscount.checked && discountInfo.discountCode.value.trim()) {
            discount = 0; 
            document.getElementById('discount-amount').textContent = discount.toFixed(2);
        } else {
            document.getElementById('discount-amount').textContent = '0.00';
        }

        const grandTotal = total + shipping - discount;
        document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
    };

    document.querySelectorAll('.next-section').forEach(button => {
        button.addEventListener('click', () => {
            const currentSection = button.closest('.checkout-section');
            const nextSectionId = button.dataset.next;
            let isValid = true;

            if (currentSection.id === 'billing-info-section') {
                isValid = validateFields(billingInfo, fieldNames);
            } else if (currentSection.id === 'payment-method-section') {
                isValid = validateFields(paymentInfo, fieldNames);
            } else if (currentSection.id === 'shipping-info-section') {
                if (!document.querySelector('input[name="shipping_option"]:checked')) {
                    displayError(document.querySelector('input[name="shipping_option"]'), 'Please select a shipping option.');
                    isValid = false;
                } else {
                    clearError(document.querySelector('input[name="shipping_option"]'));
                }
            }

            if (isValid) {
                document.getElementById(nextSectionId).style.display = 'block';
                if (nextSectionId === 'order-summary-section') {
                    calculateTotal();
                }
            }
        });
    });

    document.querySelectorAll('.back-section').forEach(button => {
        button.addEventListener('click', () => {
            const currentSection = button.closest('.checkout-section');
            const backSectionId = button.dataset.back;
            currentSection.style.display = 'none';
            document.getElementById(backSectionId).style.display = 'block';
        });
    });

    discountInfo.applyDiscount.addEventListener('change', () => {
        document.getElementById('discount-code-input').style.display = discountInfo.applyDiscount.checked ? 'block' : 'none';
        calculateTotal();
    });

    document.querySelectorAll('input[name="shipping_option"]').forEach(radio => {
        radio.addEventListener('change', calculateTotal);
    });

    document.getElementById('place-order-btn').addEventListener('click', (event) => {
        event.preventDefault();

        const allValid =
            validateFields(billingInfo, fieldNames) &&
            validateFields(paymentInfo, fieldNames) &&
            document.querySelector('input[name="shipping_option"]:checked');

        if (allValid) {
            Object.assign(billingInfo, paymentInfo, { shippingOption: document.querySelector('input[name="shipping_option"]:checked') }, {discountCode: discountInfo.discountCode}, {applyDiscount: discountInfo.applyDiscount});

            const valuesToSend = { ...billingInfo, ...paymentInfo, shippingOption: document.querySelector('input[name="shipping_option"]:checked'), discountCode: discountInfo.discountCode, applyDiscount: discountInfo.applyDiscount};

            for (let [key, field] of Object.entries(valuesToSend)) {
                const hiddenInput = document.getElementById(`${key}-input`);
                if (hiddenInput && field) {
                    hiddenInput.value = field.value ? field.value.trim() : field.value;
                }
            }

            document.getElementById('shipping-input').value = document.querySelector('input[name="shipping_option"]:checked').value;
            document.getElementById('discount-code-input-final').value = discountInfo.discountCode.value;
            document.getElementById('discount-applied-input').value = discountInfo.applyDiscount.checked ? 1 : 0;
            document.getElementById('order-form').submit();
        } else {
            alert('Please correct the errors before submitting.');
        }
    });
});