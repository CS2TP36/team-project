document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('changepassForm');

    // This Maps input field ID's to the corresponding DOM elements allowing for easy access to input fields for valifation or data retrieval
    const fields = {
        password: document.getElementById('password'),
        password_confirmation: document.getElementById('password_confirmation'),
    };

    // This Maps input field ID's to the names given enhancing error messages and user feedback
    const fieldNames = {
        password: 'Password',
        password_confirmation: 'Confirm Password',
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

            if (key === 'password') {
                const passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?/~`\\-]).{8,}$/;
                if (!passwordPattern.test(value)) {
                    displayError(field, 'Password must be at least 8 characters, contain a number and a special character.');
                    isValid = false;
                }
            }

            if (key === 'password_confirmation' && value !== fields.password.value) {
                displayError(field, 'Passwords do not match');
                isValid = false;
            }

        }

        return isValid;
    };

    // Form submission handling
    form.addEventListener('submit', (event) => {
        if (!validateFields()) {
            event.preventDefault();
        }
    });

});