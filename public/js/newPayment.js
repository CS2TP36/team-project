document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('newPaymentForm');

    const fields = {
        cardName: document.getElementById('cardName'),
        cardNumber: document.getElementById('cardNumber'),
        expiryMonth: document.getElementById('expiryMonth'),
        expiryYear: document.getElementById('expiryYear'),
        cardCvc: document.getElementById('cardCvc'),
    };

    const fieldNames = {
        cardName: 'Name on Card',
        cardNumber: 'Card Number',
        expiryMonth: 'Expiry Month',
        expiryYear: 'Expiry Year',
        cardCvc: 'CVV',
    };

    const displayError = (inputElement, message) => {
        let errorSpan = inputElement.parentElement.querySelector('.error-message');
        if (inputElement.id === 'expiryMonth' || inputElement.id === 'expiryYear') {
            errorSpan = document.getElementById('expiryDateError');
        }
        if (!errorSpan) {
            errorSpan = document.createElement('span');
            errorSpan.className = 'error-message active';
            inputElement.parentElement.appendChild(errorSpan);
        }
        errorSpan.textContent = message;
        errorSpan.classList.add('active');
        inputElement.classList.add('error');
    };

    const clearError = (inputElement) => {
        let errorSpan = inputElement.parentElement.querySelector('.error-message');

        if (inputElement.id === 'expiryMonth' || inputElement.id === 'expiryYear') {
            errorSpan = document.getElementById('expiryDateError');
        }

        if (errorSpan) {
            errorSpan.textContent = "";
            errorSpan.classList.remove('active');
        }
        inputElement.classList.remove('error');
    };

    const validateFields = () => {
        let isValid = true;

        for (let key in fields) {
            if (fields.hasOwnProperty(key)) {
                const field = fields[key];
                const fieldName = fieldNames[key];
                const value = field.value.trim();

                if (!value) {
                    displayError(field, `${fieldName} is required.`);
                    isValid = false;
                    continue;
                } else {
                    clearError(field);
                }

                if (key === 'cardNumber') {
                    const cardNumberPattern = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
                    if (!cardNumberPattern.test(value)) {
                        displayError(field, 'Enter a valid card number (1111-2222-3333-4444).');
                        isValid = false;
                    }
                }

                if (key === 'expiryMonth' || key === 'expiryYear') {
                    const monthValue = fields.expiryMonth.value.trim();
                    const yearValue = fields.expiryYear.value.trim();

                    if (!monthValue || !yearValue) {
                        displayError(fields.expiryMonth, 'Expiry date is required.');
                        isValid = false;
                    } else {
                        const expiryDatePattern = /^(0[1-9]|1[0-2])$/;
                        const yearPattern = /^\d{2}$/;

                        if (!expiryDatePattern.test(monthValue) || !yearPattern.test(yearValue)) {
                            displayError(fields.expiryMonth, 'Enter a valid expiry date (MM/YY).');
                            isValid = false;
                        } else {
                            const currentYear = new Date().getFullYear() % 100;
                            const inputYear = parseInt(yearValue, 10);
                            const inputMonth = parseInt(monthValue, 10);

                            if (inputYear < currentYear || (inputYear === currentYear && inputMonth < new Date().getMonth() + 1)) {
                                displayError(fields.expiryMonth, 'Expiry date must be in the future.');
                                isValid = false;
                            } else if (inputYear === currentYear + 0 && inputMonth < new Date().getMonth() + 1) {
                                displayError(fields.expiryMonth, 'Expiry date must be in the future.');
                                isValid = false;
                            } else if (inputYear < 25) {
                                displayError(fields.expiryMonth, 'Expiry Year must be 2025 or later');
                                isValid = false;
                            }
                        }
                    }
                }

                if (key === 'cardName') {
                    const namePattern = /^[A-Za-z\s]+$/;
                    if (!namePattern.test(value)) {
                        displayError(field, 'Enter a valid name (letters and spaces only).');
                        isValid = false;
                    }
                }

                if (key === 'cardCvc') {
                    const cvvPattern = /^\d{3,4}$/;
                    if (!cvvPattern.test(value)) {
                        displayError(field, 'Enter a valid CVV (3 or 4 digits).');
                        isValid = false;
                    }
                }
            }
        }

        return isValid;
    };

    Object.values(fields).forEach((field) => {
        field.addEventListener('input', () => {
            clearError(field);
            if (field.id === 'expiryMonth' || field.id === 'expiryYear') {
                validateFields();
            }
        });
    });

    form.addEventListener('submit', (event) => {
        if (!validateFields()) {
            event.preventDefault();
        }
    });
});