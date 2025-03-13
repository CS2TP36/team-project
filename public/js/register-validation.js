document.addEventListener('DOMContentLoaded', () => {
    const registerForm = {
        firstName: document.getElementById('firstName'),
        lastName: document.getElementById('lastName'),
        email: document.getElementById('email'),
        password: document.getElementById('password'),
        password_confirmation: document.getElementById('password_confirmation'),
        phone: document.getElementById('phone'),
        address: document.getElementById('address'),
    };

    const registerFieldNames = {
        firstName: 'First Name',
        lastName: 'Last Name',
        email: 'Email',
        password: 'Password',
        password_confirmation: 'Confirm Password',
        phone: 'Phone Number',
        address: 'Address',
    };

    const registerValidationRules = {
        firstName: {}, // Required
        lastName: {}, // Required
        email: {
            pattern: "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,6}$",
            message: "must be a valid email address."
        },
        password: {
            pattern: "^.{8,}$",
            message: "must be at least 8 characters long."
        },
        password_confirmation: {}, // Will be compared to password
        phone: {
            pattern: "^\\+44\\d{10,13}$",
            message: "must be a valid UK phone number (e.g., +441234567890)."
        },
        address: {}, // Required
    };

    // Reusable error handling functions:
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

    function validateField(inputElement, fieldName, validationRules) {
        clearError(inputElement); // Clear any existing errors

        if (!inputElement.value || !inputElement.value.trim()) {
            displayError(inputElement, `${fieldName} is required.`);
            return false;
        }

        if (validationRules && validationRules.pattern) {
            const pattern = new RegExp(validationRules.pattern);
            if (!pattern.test(inputElement.value.trim())) {
                displayError(inputElement, `${fieldName} ${validationRules.message}`);
                return false;
            }
        }

        return true;
    }

    function validateFields(fields, fieldNames, validationRules) {
        let isValid = true;

        for (let key in fields) {
            const field = fields[key];
            const fieldName = fieldNames[key];
            const rules = validationRules[key];

            if (!validateField(field, fieldName, rules)) {
                isValid = false;
            }
        }

        // Special check for password confirmation:
        if (fields.password_confirmation && fields.password.password.value !== fields.password_confirmation.value) {
            displayError(fields.password_confirmation, "Passwords do not match.");
            isValid = false;
        }
        return isValid;
    }

    document.getElementById('signupForm').addEventListener('submit', (event) => {
        if (!validateFields(registerForm, registerFieldNames, registerValidationRules)) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});