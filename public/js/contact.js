document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');

    // This Maps input field ID's to the corresponding DOM elements allowing for easy access to input fields for valifation or data retrieval
    const fields = {
        name: document.getElementById('name'),
        email: document.getElementById('email'),
        phone: document.getElementById('phone'),
    };

    // This Maps input field ID's to the names given enhancing error messages and user feedback
    const fieldNames = {
        name: 'Name',
        email: 'Email',
        phone: 'Phone Number',
    };

    // Error handling functions
    const displayError = (inputElement, message) => {
        let errorSpan = inputElement.parentElement.querySelector('.error-message');
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
        const errorSpan = inputElement.parentElement.querySelector('.error-message');
        if (errorSpan) {
            errorSpan.textContent = "";
            errorSpan.classList.remove('active');
        }
        inputElement.classList.remove('error');
    };

    // Field validation function
    const validateFields = () => {
        let isValid = true;

        for (let key in fields) {
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

            if (key === 'email') {
                const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!emailPattern.test(value)) {
                    displayError(field, 'Enter a valid email address.');
                    isValid = false;
                }
            }

            if (key === 'phone') {
                const phonePattern = /^(?:\+44\s?\d{4}\s?\d{6}|0\d{4}\s?\d{6})$/;
                if (!phonePattern.test(value)) {
                    displayError(field, 'Enter a valid UK phone number (e.g., +44 7000 000000 or 07000 000000).');
                    isValid = false;
                }
            }
        }

        return isValid;
    };

    // Real-time validation
    Object.values(fields).forEach((field) => {
        field.addEventListener('input', () => {
            clearError(field);
        });
    });

    // Form submission handling
    form.addEventListener('submit', (event) => {
        if (!validateFields()) {
            event.preventDefault();
        }
    });
});