const signupForm = document.getElementById('signupForm');

signupForm.addEventListener('submit', function(event) {
    event.preventDefault();

    console.log("Form submitted!");

    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const phoneNumber = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();

    let isValid = true;

    // Clear previous errors
    document.querySelectorAll('.error').forEach(error => error.textContent = '');

    // First name validation
    if (firstName === '') {
        document.getElementById('firstNameError').textContent = 'Please provide your first name.';
        isValid = false;
    }

    // Last name validation
    if (lastName === '') {
        document.getElementById('lastNameError').textContent = 'Last name is required.';
        isValid = false;
    }

    // Email validation
    if (email === '') {
        document.getElementById('emailError').textContent = 'Don’t forget to enter your email.';
        isValid = false;
    } else if (!isValidEmail(email)) {
        document.getElementById('emailError').textContent = 'That doesn’t look like a valid email.';
        isValid = false;
    }

    // Password validation
    if (password === '') {
        document.getElementById('passwordError').textContent = 'You need to choose a password.';
        isValid = false;
    } else if (password.length < 8) {
        document.getElementById('passwordError').textContent = 'Password should be at least 8 characters long.';
        isValid = false;
    }

    // Confirm password validation
    if (confirmPassword === '') {
        document.getElementById('confirmPasswordError').textContent = 'Please confirm your password.';
        isValid = false;
    } else if (password !== confirmPassword) {
        document.getElementById('confirmPasswordError').textContent = 'Passwords don’t match. Try again.';
        isValid = false;
    }

    // Phone number validation
    if (phoneNumber === '') {
        document.getElementById('phoneError').textContent = 'We need your phone number.';
        isValid = false;
    } else if (!isValidPhoneNumber(phoneNumber)) {
        document.getElementById('phoneError').textContent = 'Please provide a valid UK phone number.';
        isValid = false;
    }

    // Address validation
    if (address === '') {
        document.getElementById('addressError').textContent = 'Address is required.';
        isValid = false;
    } else if (address.length < 5) {
        document.getElementById('addressError').textContent = 'Your address seems too short. Please enter a valid address.';
        isValid = false;
    }

    // Submit form if everything is valid
    if (isValid) {
        console.log("Form is valid. Submitting...");
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
