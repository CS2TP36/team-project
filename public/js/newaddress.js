document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('newaddressForm');

    // This Maps input field ID's to the corresponding DOM elements allowing for easy access to input fields for valifation or data retrieval
    const fields = {
        fullName: document.getElementById('full-name'),
        phone: document.getElementById('phone'),
        postcode: document.getElementById('postcode'),
        address_line1: document.getElementById('addressline1'),
        city: document.getElementById('city'),
    };
    
    // This Maps input field ID's to the names given enhancing error messages and user feedback
    const fieldNames = {
        fullName: 'Full Name',
        phone: 'Phone Number',
        postcode: 'Postcode',
        address_line1: 'Address Line 1',
        city: 'City',
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
      
          if (key === 'phone') {
              const phonePattern = /^(?:\+44\s?\d{4}\s?\d{6}|\+44\d{10}|0\d{4}\s?\d{6}|0\d{10})$/;
            if (!phonePattern.test(value)) {
              displayError(field, 'Enter a valid UK phone number (e.g., +44 7000 000000, +447000000000, 07000 000000, 07000000000).');
              isValid = false;
            }
          }
      
          if (key === 'postcode') {
            const postcodePattern = !/^[a-zA-Z0-9\s]{5,8}$/;
            if (!postcodePattern.test(value)) {
              displayError(field, 'Enter a valid postcode (5-7 alphanumeric characters).');
              isValid = false;
            }
          }
      
          if (key === 'address_line1') {
              if(value.length < 1){
                  displayError(field,'Address Line 1 is required');
                  isValid = false;
              }
      
          }
      
          if (key === 'city') {
            const cityPattern = /^[A-Za-z\s-]+$/; 
            if (!cityPattern.test(value)) {
              displayError(field, 'Enter a valid city name (letters, spaces, and hyphens only).');
              isValid = false;
            }
          }
      
          if (key === 'fullName') {
              const namePattern = /^[A-Za-z\s]+$/;
            if (!namePattern.test(value)) {
              displayError(field, 'Enter a valid full name (letters and spaces only).');
              isValid = false;
            }
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