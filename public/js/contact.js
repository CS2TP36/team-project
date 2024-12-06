function validateContactForm(event) {
    event.preventDefault();

    const fullName = document.getElementById('name').value.trim();

    const userEmail = document.getElementById('email').value.trim();

    const userPhone = document.getElementById('phone').value.trim();

    const userMessage = document.getElementById('message').value.trim();

    if (fullName === "") {
        alert("Sorry! Your Full Name Has Not Been Provided.");
        return false;
    }

    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!userEmail.match(emailRegex)) {
        alert("Invalid email address. Please double-check.");
        return false;
    }


    if (userMessage === "") {
        alert("Don't forget to include a message, we would love to hear your query.");
        return false;
    }

    alert(`Thank you, ${fullName}! Your message has been sent.`);
    document.querySelector("form").submit();
}
