document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');

    // This Maps input field ID's to the corresponding DOM elements allowing for easy access to input fields for valifation or data retrieval
    const fields = {
        email: document.getElementById('email'),
        password: document.getElementById('password'),
    };

    // This Maps input field ID's to the names given enhancing error messages and user feedback
    const fieldNames = {
        email: 'Email',
        password: 'Password',
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

            if (key === 'password' && value.length < 8) {
                displayError(field, 'Password must be at least 8 characters.');
                isValid = false;
            }

            return isValid;
        };
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
