document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('forgotpassForm');

    const fields = {
        email: document.querySelector('input[name="email"]'),
        firstInitial: document.querySelector('input[name="firstInitial"]'),
        lastInitial: document.querySelector('input[name="lastInitial"]')
    };

    const fieldNames = {
        email: 'Email',
        firstInitial: 'First Initial',
        lastInitial: 'Last Initial'
    };

    // Function to display error
    const displayError = (inputElement, message) => {
        let errorSpan = inputElement.nextElementSibling;
        if (!errorSpan || !errorSpan.classList.contains('error-message')) {
            errorSpan = document.createElement('span');
            errorSpan.className = 'error-message active';
            inputElement.parentElement.appendChild(errorSpan);
        }
        errorSpan.textContent = message;
        inputElement.classList.add('error');
        errorSpan.classList.add('active');
    };

    // Function to clear error
    const clearError = (inputElement) => {
        const errorSpan = inputElement.nextElementSibling;
        if (errorSpan && errorSpan.classList.contains('error-message')) {
            errorSpan.textContent = "";
            errorSpan.classList.remove('active');
        }
        inputElement.classList.remove('error');
    };

    // Validate function
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

            if ((key === 'firstInitial' || key === 'lastInitial') && !/^[A-Z]$/.test(value)) {
                displayError(field, `${fieldName} must be a single uppercase letter.`);
                isValid = false;
            }
        }

        return isValid;
    };

    // Real-time validation
    Object.values(fields).forEach((field) => {
        field.addEventListener('input', () => clearError(field));
    });

    // Submit event
    form.addEventListener('submit', async (event) => {
        if (!validateFields()) {
            event.preventDefault();
            return;
        }

        // Backend initials verification
        const response = await fetch('/validate-initials', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                email: fields.email.value.trim(),
                firstInitial: fields.firstInitial.value.trim(),
                lastInitial: fields.lastInitial.value.trim()
            })
        });

        const result = await response.json();
        if (!result.success) {
            event.preventDefault();
            displayError(fields.firstInitial, 'Initials do not match our records.');
            displayError(fields.lastInitial, 'Initials do not match our records.');
        }
    });
});
