document.addEventListener('DOMContentLoaded', () => {
    const signupForm = document.getElementById('signupForm');

    signupForm.addEventListener('submit', function (event) {
        event.preventDefault();

        // Creates an object to store references to the input fields making for a easier to access and validate the input values.
        const fields = {
            firstName: document.getElementById('firstName'),
            lastName: document.getElementById('lastName'),
            email: document.getElementById('email'),
            password: document.getElementById('password'),
            confirmPassword: document.getElementById('password_confirmation'),
            phone: document.getElementById('phone'),
            address: document.getElementById('address'),
        };

        // Creates an object to store the display names of the input field and is used to display user-friendly error messages
        const fieldNames = {
            firstName: 'First Name',
            lastName: 'Last Name',
            email: 'Email',
            password: 'Password',
            confirmPassword: 'Confirm Password',
            phone: 'Phone Number',
            address: 'Address',
        };

        let isValid = true;

        // Clear previous errors
        for (const key in fields) {
            clearError(fields[key]);
        }

        // Validation
        if (!validateFields(fields, fieldNames)) {
            isValid = false;
        }

        if (fields.password.value !== fields.confirmPassword.value) {
            displayError(fields.confirmPassword, 'Passwords don’t match. Try again.');
            isValid = false;
        }

        if (fields.phone.value && !isValidPhoneNumber(fields.phone.value)) {
            displayError(fields.phone, 'Please provide a valid UK phone number.');
            isValid = false;
        }

        if (fields.email.value && !isValidEmail(fields.email.value)) {
            displayError(fields.email, 'That doesn’t look like a valid email.');
            isValid = false;
        }

        if (isValid) {
            alert('You’ve successfully signed up! Welcome!');
            signupForm.submit();
        }
    });

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPhoneNumber(phoneNumber) {
        const ukPhoneRegex = /^\+44\d{10,13}$/;
        return ukPhoneRegex.test(phoneNumber);
    }

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
            }
        }

        return isValid;
    };
});