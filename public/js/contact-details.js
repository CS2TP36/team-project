document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('details-form');

    // This Maps input field ID's to the corresponding DOM elements allowing for easy access to input fields for validation or data retrieval
    const fields = {
        firstName: document.getElementById('first-name-new'),
        lastName: document.getElementById('last-name-new'),
        email: document.getElementById('email-new'),
        phone: document.getElementById('phone-number-new'),
    };

    // This Maps input field ID's to the names given enhancing error messages and user feedback
    const fieldNames = {
        firstName: 'First Name',
        lastName: 'Last Name',
        email: 'Email',
        phone: 'Phone Number',
    };

    // Store initial values for change tracking
    const initialValues = {
        firstName: fields.firstName.value.trim(),
        lastName: fields.lastName.value.trim(),
        email: fields.email.value.trim(),
        phone: fields.phone.value.trim(),
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
                const phonePattern = /^(?:\+44\s?\d{4}\s?\d{6}|\+44\d{10}|07\d{3}\s?\d{6}|07\d{9})$/;
                if (!phonePattern.test(value)) {
                    displayError(field, 'Enter a valid UK phone number (e.g., +44 7000 000000 or 07000 000000).');
                    isValid = false;
                }
            }
        }

        return isValid;
    };

    // Check if form values have changed
    const hasFormChanged = () => {
        return Object.keys(fields).some(key => {
            if (!fields[key]) return false; // Skip if field not found
            return fields[key].value.trim() !== initialValues[key];
        });
    };

    // Form submission handling
    form.addEventListener('submit', (event) => {
        if (!validateFields()) {
            event.preventDefault(); // Prevent form submission if validation fails
            return;
        }

        if (!hasFormChanged()) {
            event.preventDefault(); // Prevent submission if no changes were made
            alert('No changes detected. Update your details before submitting.');
        }
    });

    // Delete account confirmation
    window.confirmDelete = function() {
        if (confirm('Are you sure? This action is irreversible.')) {
            document.getElementById('delete-account-form').submit();
        }
    };
});
