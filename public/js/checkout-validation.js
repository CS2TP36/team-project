document.addEventListener('DOMContentLoaded', () => {
    const shippingInfo = { 
        fullName: document.getElementById('shipping_full_name'),
        address: document.getElementById('shipping_address_line1'),
        city: document.getElementById('shipping_city'), 
        postcode: document.getElementById('shipping_post_code'),
        phone: document.getElementById('shipping_phone'),
    };

    const paymentInfo = {
        nameOnCard: document.getElementById('card-name'),
        cardNumber: document.getElementById('card-number'),
        expiryDate: document.getElementById('expiry-date'),
        cvv: document.getElementById('cvv'),
    };

    const discountInfo = {
        applyDiscount: document.getElementById('apply-discount'),
        discountCode: document.getElementById('discount_code'),
    };

    const fieldNames = {
        fullName: 'Full Name',
        address: 'Street Address',
        city: 'City',
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

    const displayShippingError = (inputElement, message) => {
        let errorSpan = inputElement.parentElement.querySelector('.error-message'); 
        if (!errorSpan) {
            errorSpan = document.createElement('span');
            errorSpan.className = 'error-message'; 
            inputElement.parentElement.appendChild(errorSpan);
        }
        errorSpan.textContent = message;
        inputElement.classList.add('error');
    };
    
    const clearShippingError = (inputElement) => {
        const errorSpan = inputElement.parentElement.querySelector('.error-message'); 
        if (errorSpan) errorSpan.remove();
        inputElement.classList.remove('error');
    };

    const shippingAddressRadios = document.querySelectorAll('input[name="address_choice"]');
    const storedAddressesDiv = document.getElementById('stored-addresses');
    const defaultAddressDiv = document.getElementById('default-address');
    const newAddressFieldsDiv = document.getElementById('new-address-fields');
    
    shippingAddressRadios.forEach(radio => { 
        radio.addEventListener('change', () => {
            storedAddressesDiv.style.display = radio.value === 'stored' ? 'block' : 'none';
            defaultAddressDiv.style.display = radio.value === 'default' ? 'block' : 'none';
            newAddressFieldsDiv.style.display = radio.value === 'new' ? 'block' : 'none';
        });
    });

    const paymentRadios = document.querySelectorAll('input[name="payment_choice"]');
    const storedPaymentsDiv = document.getElementById('stored-payments');
    const defaultPaymentDiv = document.getElementById('default-payment');
    const newPaymentFieldsDiv = document.getElementById('new-payment-fields');

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            storedPaymentsDiv.style.display = radio.value === 'stored' ? 'block' : 'none';
            defaultPaymentDiv.style.display = radio.value === 'default' ? 'block' : 'none';
            newPaymentFieldsDiv.style.display = radio.value === 'new' ? 'block' : 'none';
        });
    });

    const discountApplyRadios = document.querySelectorAll('input[name="apply_discount"]');
    const discountCodeInput = document.getElementById('discount-code-input');
    const discountCode = document.getElementById('discount_code');

    discountApplyRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            discountCodeInput.style.display = radio.value === 'yes' ? 'block' : 'none';
            calculateTotal();
        });
    });

    const validateShippingFields = () => {
        let isValid = true;
        const selectedOption = document.querySelector('input[name="address_choice"]:checked').value;
        if (selectedOption === 'new') {
            const fullName = document.getElementById('shipping_full_name');
            const address = document.getElementById('shipping_address_line1');
            const city = document.getElementById('shipping_city');
            const postcode = document.getElementById('shipping_post_code');
            const phone = document.getElementById('shipping_phone');
    
            if (!/^[a-zA-Z\s]+$/.test(fullName.value)) {
                displayShippingError(fullName, "Full name is not valid");
                isValid = false;
            } else { clearShippingError(fullName); }
            if (address.value.trim() === '') {
                displayShippingError(address, "Address is required");
                isValid = false;
            } else { clearShippingError(address); }
            if (city.value.trim() === '') {
                displayShippingError(city, "City is required");
                isValid = false;
            } else { clearShippingError(city); }
            if (!/^[a-zA-Z0-9\s]{5,8}$/.test(postcode.value)) {
                displayShippingError(postcode, "Postcode is not valid");
                isValid = false;
            } else { clearShippingError(postcode); }
            if (!/^(?:\+44\s?\d{4}\s?\d{6}|\+44\d{10}|07\d{3}\s?\d{6}|07\d{9})$/.test(phone.value)) {
                displayShippingError(phone, "Phone number is not valid");
                isValid = false;
            } else { clearShippingError(phone); }
        }
    
        return isValid;
    };

    const validatePaymentFields = () => {
        let isValid = true;
        const selectedOption = document.querySelector('input[name="payment_choice"]:checked').value;
        if (selectedOption === 'new') {
            const cardName = document.getElementById('card-name');
            const cardNumber = document.getElementById('card-number');
            const expiryDate = document.getElementById('expiry-date');
            const cvv = document.getElementById('cvv');

            if (!/^[a-zA-Z\s]+$/.test(cardName.value)) {
                displayError(cardName, "Name on card is not valid");
                isValid = false;
            } else { clearError(cardName); }
            if (!/^\d{4}-\d{4}-\d{4}-\d{4}$/.test(cardNumber.value)) {
                displayError(cardNumber, "Card number is not valid");
                isValid = false;
            } else { clearError(cardNumber); }
            const expiryDatePattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
            if (!expiryDatePattern.test(expiryDate.value)) {
                displayError(expiryDate, "Expiry date format is MM/YY");
                isValid = false;
            } else { clearError(expiryDate); }
            if (!/^\d{3}$/.test(cvv.value)) {
                displayError(cvv, "CVV is not valid");
                isValid = false;
            } else { clearError(cvv); }

        }
        return isValid;
    };

    const validateDiscount = () => {
        let isValid = true;
        const selectedOption = document.querySelector('input[name="apply_discount"]:checked');
    
        if (selectedOption) {
            if (selectedOption.value === 'yes' && document.getElementById('discount_code').value.trim() === '') {
                displayError(document.getElementById('discount_code'), "Discount code is required.");
                isValid = false;
            } else {
                clearError(document.getElementById('discount_code'));
            }
        } else {
            isValid = false;
            alert("Please select a discount option.");
        }
        return isValid;
    };

    document.querySelectorAll('.next-section').forEach(button => {
        button.addEventListener('click', () => {
            const currentSection = button.closest('.checkout-section');
            const nextSectionId = button.dataset.next;
            let isValid = true;
    
            if (currentSection.id === 'shipping-info-section') {
                isValid = validateShippingFields();
                if (isValid && !document.querySelector('input[name="address_choice"]:checked')) {
                    isValid = false;
                    alert('Please select a shipping address option.');
                }
                if (isValid && !document.querySelector('input[name="shipping_option"]:checked')) {
                    displayShippingError(document.querySelector('input[name="shipping_option"]'), 'Please select a shipping option.');
                    isValid = false;
                } else {
                    clearShippingError(document.querySelector('input[name="shipping_option"]'));
                }
            } else if (currentSection.id === 'payment-method-section') {
                isValid = validatePaymentFields();
                if (isValid && !document.querySelector('input[name="payment_choice"]:checked')) {
                    isValid = false;
                    alert('Please select a payment method option.');
                }
            } else if (currentSection.id === 'discount-section') {
                isValid = validateDiscount();
                if (isValid && !document.querySelector('input[name="apply_discount"]:checked')) {
                    isValid = false;
                    alert('Please select a discount option.');
                }
            }
    
            if (isValid) {
                document.getElementById(nextSectionId).style.display = 'block';
                currentSection.style.display = 'none';
                if (nextSectionId === 'order-summary-section') {
                    calculateTotal();
                }
            }
        });
    });

    const calculateTotal = () => {
        let total = parseFloat(document.getElementById('subtotal-price').textContent.replace(',', ''));
        let shipping = 0;
        let discount = 0;
    
        const shippingOption = document.querySelector('input[name="shipping_option"]:checked');
        if (shippingOption) {
            if (shippingOption.value === 'standard') shipping = 4.49;
            else if (shippingOption.value === 'next_day') shipping = 6.49;
            else if (shippingOption.value === 'priority') shipping = 5.49;
        }
    
        document.getElementById('shipping-price').textContent = shipping.toFixed(2);
    
        const discountRadio = document.querySelector('input[name="apply_discount"]:checked');
        if (discountRadio && discountRadio.value === 'yes' && document.getElementById('discount_code').value.trim()) {
            discount = 0; 
            document.getElementById('discount-amount').textContent = discount.toFixed(2);
        } else {
            document.getElementById('discount-amount').textContent = '0.00';
        }
    
        document.getElementById('shipping_option_hidden').value = document.querySelector('input[name="shipping_option"]:checked').value;
        document.getElementById('apply_discount_hidden').value = discountRadio && discountRadio.value === 'yes' ? 1 : 0;
        document.getElementById('discount_code_hidden').value = document.getElementById('discount_code').value;
    
        const formData = new FormData(document.getElementById('shipping-form'));
        const paymentFormData = new FormData(document.getElementById('payment-form'));
    
        if (document.querySelector('input[name="address_choice"]:checked').value === 'new') {
            document.getElementById('shipping_full_name_hidden').value = formData.get('shipping_full_name'); 
            document.getElementById('shipping_address_line1_hidden').value = formData.get('shipping_address_line1'); 
            document.getElementById('shipping_post_code_hidden').value = formData.get('shipping_post_code'); 
            document.getElementById('shipping_phone_hidden').value = formData.get('shipping_phone'); 
            document.getElementById('shipping_city_hidden').value = formData.get('shipping_city'); 
            document.getElementById('save_new_address_hidden').value = formData.get('save_address') ? 1 : 0;
        } else if (document.querySelector('input[name="address_choice"]:checked').value === 'stored') {
            document.getElementById('shipping_address_hidden').value = document.getElementById('stored_address_id').value;
        } else if (document.querySelector('input[name="address_choice"]:checked').value === 'default') {
            document.getElementById('shipping_address_hidden').value = document.getElementById('default_address_id').value;
        }
    
        if (document.querySelector('input[name="payment_choice"]:checked').value === 'new') {
            document.getElementById('payment_card_name_hidden').value = paymentFormData.get('card_name');
            document.getElementById('payment_card_number_hidden').value = paymentFormData.get('card_number');
            document.getElementById('payment_expiry_hidden').value = paymentFormData.get('expiry_date');
            document.getElementById('payment_cvv_hidden').value = paymentFormData.get('cvv');
            document.getElementById('save_new_payment_hidden').value = paymentFormData.get('save_payment') ? 1 : 0;
        } else if (document.querySelector('input[name="payment_choice"]:checked').value === 'stored') {
            document.getElementById('payment_method_hidden').value = document.getElementById('stored_payment_id').value;
        } else if (document.querySelector('input[name="payment_choice"]:checked').value === 'default') {
            document.getElementById('payment_method_hidden').value = document.getElementById('default_payment_id').value;
        }
    
        const grandTotal = total + shipping - discount;
        document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
    };

    document.querySelectorAll('.next-section').forEach(button => {
        button.addEventListener('click', () => {
            const currentSection = button.closest('.checkout-section');
            const nextSectionId = button.dataset.next;
            let isValid = true;

            if (currentSection.id === 'shipping-info-section') {
                isValid = validateShippingFields();
                if (isValid && !document.querySelector('input[name="address_choice"]:checked')) {
                    isValid = false;
                    alert('Please select a shipping address option.');
                }            
            } else if (currentSection.id === 'payment-method-section') {
                isValid = validatePaymentFields();
                if (isValid && !document.querySelector('input[name="payment_choice"]:checked')) {
                    isValid = false;
                    alert('Please select a payment method option.');
                }
            } else if (currentSection.id === 'shipping-info-section') {
                if (!document.querySelector('input[name="shipping_option"]:checked')) {
                    displayError(document.querySelector('input[name="shipping_option"]'), 'Please select a shipping option.');
                    isValid = false;
                } else {
                    clearError(document.querySelector('input[name="shipping_option"]'));
                }
            } else if (currentSection.id === 'discount-section') {
                isValid = validateDiscount();
                if (isValid && !document.querySelector('input[name="apply-discount"]:checked')) {
                    isValid = false;
                    alert('Please select a discount option.');
                }

            }

            if (isValid) {
                document.getElementById(nextSectionId).style.display = 'block';
                currentSection.style.display = 'none';
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

    document.querySelectorAll('input[name="shipping_option"]').forEach(radio => {
        radio.addEventListener('change', calculateTotal);
    });

    document.getElementById('order-form').addEventListener('submit', (event) => {
        event.preventDefault();
    
        const shippingValid = validateShippingFields();
        const paymentValid = validatePaymentFields();
        const shippingOptionValid = document.querySelector('input[name="shipping_option"]:checked');
        const discountValid = validateDiscount();
        const addressSelection = document.querySelector('input[name="address_choice"]:checked');
        const paymentSelection = document.querySelector('input[name="payment_choice"]:checked');
    
        if (shippingValid && paymentValid && shippingOptionValid && discountValid && addressSelection && paymentSelection) {
            document.getElementById('order-form').submit();
        } else {
            alert('Please correct the errors before submitting.');
        }
    });
})
