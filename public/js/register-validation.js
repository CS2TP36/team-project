document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('signupForm');

    // This Maps input field ID's to the corresponding DOM elements allowing for easy access to input fields for valifation or data retrieval
    const fields = {
        firstName: document.getElementById('firstName'),
        lastName: document.getElementById('lastName'),
        email: document.getElementById('email'),
        password: document.getElementById('password'),
        password_confirmation: document.getElementById('password_confirmation'),
        phone: document.getElementById('phone'),
        address: document.getElementById('address'),
    };

    // This Maps input field ID's to the names given enhancing error messages and user feedback
    const fieldNames = {
        firstName: 'First Name',
        lastName: 'Last Name',
        email: 'Email',
        password: 'Password',
        password_confirmation: 'Confirm Password',
        phone: 'Phone Number',
        address: 'Address',
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
            
            if (key === 'phone') {
                const phonePattern = /^(?:\+44\s?\d{4}\s?\d{6}|\+44\d{10}|07\d{3}\s?\d{6}|07\d{9})$/;
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