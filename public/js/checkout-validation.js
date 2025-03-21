document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.next-section').forEach(btn => {
        btn.addEventListener('click', () => {
            const nextId = btn.dataset.next;
            btn.closest('.checkout-section').style.display = 'none';
            document.getElementById(nextId).style.display = 'block';
        });
    });
    document.querySelectorAll('.back-section').forEach(btn => {
        btn.addEventListener('click', () => {
            const backId = btn.dataset.back;
            btn.closest('.checkout-section').style.display = 'none';
            document.getElementById(backId).style.display = 'block';
        });
    });

    const shippingNextBtn = document.getElementById('shipping-next-btn');
    const sameAsShippingCheckbox = document.getElementById('same_as_shipping');
//    const billingSection = document.getElementById('billing-info-section');
    const paymentSection = document.getElementById('payment-method-section');

    shippingNextBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        document.getElementById('shipping-info-section').style.display = 'none';
//        if (sameAsShippingCheckbox.checked) {
            paymentSection.style.display = 'block';
//        } else {
//            billingSection.style.display = 'block';
//        }
    });

    // shows billing address fields if "same as shipping" checkbox unselected
    const billingFields = document.getElementById('billing-fields');
    sameAsShippingCheckbox.addEventListener('change', () => {
        billingFields.style.display = sameAsShippingCheckbox.checked ? 'none' : 'block';
    });


    const addressRadios = document.getElementsByName('shipping_address');
    const newShippingFields = document.getElementById('new-shipping-fields');
    if (addressRadios.length > 0) {
        addressRadios.forEach(radio => {
            radio.addEventListener('change', e => {
                if (e.target.value === 'new') {
                    newShippingFields.style.display = 'block';
                } else {
                    newShippingFields.style.display = 'none';
                }
            });
        });
    }

    const paymentMethodRadios = document.getElementsByName('payment_method');
    const newPaymentFields = document.getElementById('new-payment-fields');
    if (paymentMethodRadios.length > 0) {
        paymentMethodRadios.forEach(radio => {
            radio.addEventListener('change', e => {
                if (e.target.value === 'new') {
                    newPaymentFields.style.display = 'block';
                } else {
                    newPaymentFields.style.display = 'none';
                }
            });
        });
    }

    const applyDiscountCheckbox = document.getElementById('apply-discount');
    const discountCodeField = document.getElementById('discount-code-field');
    const discountCodeInput = document.getElementById('discount_code');

    if (applyDiscountCheckbox) {
        applyDiscountCheckbox.addEventListener('change', () => {
            discountCodeField.style.display = applyDiscountCheckbox.checked ? 'block' : 'none';
            fetchExactDiscount();
        });
    }
    if (discountCodeInput) {
        discountCodeInput.addEventListener('input', () => {
            fetchExactDiscount();
        });
    }

    // fills in hidden form for submission
    const finalNext = document.querySelector('[data-next="order-summary-section"]');
    finalNext.addEventListener('click', () => {
        const selectedShipping = document.querySelector('input[name="shipping_address"]:checked');
        document.getElementById('shipping_address_hidden').value = selectedShipping ? selectedShipping.value : '';

        if (selectedShipping && selectedShipping.value === 'new') {
            document.getElementById('shipping_full_name_hidden').value    = document.getElementById('shipping_full_name').value;
            document.getElementById('shipping_address_line1_hidden').value= document.getElementById('shipping_address_line1').value;
            document.getElementById('shipping_city_hidden').value         = document.getElementById('shipping_city').value;
            document.getElementById('shipping_post_code_hidden').value    = document.getElementById('shipping_post_code').value;
            document.getElementById('shipping_phone_hidden').value        = document.getElementById('shipping_phone').value;
            document.getElementById('save_new_address_hidden').value      = document.getElementById('save_new_address').checked ? '1' : '0';
        }

        document.getElementById('same_as_shipping_hidden').value = sameAsShippingCheckbox.checked ? 'on' : 'off';

        if (!sameAsShippingCheckbox.checked) {
            document.getElementById('billing_full_name_hidden').value = document.getElementById('billing_full_name').value;
            document.getElementById('billing_address_hidden').value   = document.getElementById('billing_address').value;
            document.getElementById('billing_city_hidden').value      = document.getElementById('billing_city').value;
            document.getElementById('billing_postcode_hidden').value  = document.getElementById('billing_postcode').value;
        }

        const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
        document.getElementById('payment_method_hidden').value = selectedPayment ? selectedPayment.value : '';

        if (selectedPayment && selectedPayment.value === 'new') {
            document.getElementById('payment_card_name_hidden').value   = document.getElementById('payment_card_name').value;
            document.getElementById('payment_card_number_hidden').value = document.getElementById('payment_card_number').value;
            document.getElementById('payment_expiry_hidden').value      = document.getElementById('payment_expiry').value;
            document.getElementById('payment_cvv_hidden').value         = document.getElementById('payment_cvv').value;
            document.getElementById('save_new_payment_hidden').value    = document.getElementById('save_new_payment').checked ? '1' : '0';
        }

        const selectedShippingOption = document.querySelector('input[name="shipping_option"]:checked');
        document.getElementById('shipping_option_hidden').value = selectedShippingOption ? selectedShippingOption.value : '';

        document.getElementById('apply_discount_hidden').value = applyDiscountCheckbox.checked ? '1' : '0';
        if (applyDiscountCheckbox.checked) {
            document.getElementById('discount_code_hidden').value = discountCodeInput.value;
        }

        updateGrandTotal();
    });

    // calculates shipping and adds to grand total
    const shippingOptionRadios = document.querySelectorAll('input[name="shipping_option"]');
    shippingOptionRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            updateShippingCost();
            updateGrandTotal();
        });
    });

    // calculates discount and calculates new total
    async function fetchExactDiscount() {
        const code = discountCodeInput.value.trim();
        if (!applyDiscountCheckbox.checked || !code) {
            document.getElementById('discount-amount').textContent = '0.00';
            updateGrandTotal();
            return;
        }
        try {
            const res = await fetch(`/discount-validate?code=${encodeURIComponent(code)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();

            if (!data.valid) {
                document.getElementById('discount-amount').textContent = '0.00';
            } else {
                const percentOff = parseFloat(data.percent_off) || 0;
                const subtotal = parseFloat(document.getElementById('subtotal-price').textContent) || 0;
                const discountValue = subtotal * (percentOff / 100);
                document.getElementById('discount-amount').textContent = discountValue.toFixed(2);
            }
        } catch (error) {
            document.getElementById('discount-amount').textContent = '0.00';
        }
        updateGrandTotal();
    }

    // sets shipping cost
    function updateShippingCost() {
        const selected = document.querySelector('input[name="shipping_option"]:checked');
        let shippingCost = 0;
        if (!selected) return;
        switch (selected.value) {
            case 'next_day':
                shippingCost = 6.49;
                break;
            case 'priority':
                shippingCost = 5.49;
                break;
            default:
                shippingCost = 4.49;
        }
        document.getElementById('shipping-price').textContent = shippingCost.toFixed(2);
    }
    // Updates the grand total whenever shipping cost or discount changes
    function updateGrandTotal() {
        const subtotal = parseFloat(document.getElementById('subtotal-price').textContent) || 0;
        const shipping = parseFloat(document.getElementById('shipping-price').textContent) || 0;
        const discount = parseFloat(document.getElementById('discount-amount').textContent) || 0;
        const grand = (subtotal + shipping - discount).toFixed(2);
        document.getElementById('grand-total').textContent = grand;
    }
});
