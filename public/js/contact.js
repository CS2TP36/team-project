function validateContactForm(event) {
    event.preventDefault();

    const fullName = document.getElementById('name').value.trim();
    const userEmail = document.getElementById('email').value.trim();
    const userPhone = document.getElementById('phone').value.trim();
    const userMessage = document.getElementById('message').value.trim();

    if (fullName === "" || userEmail === "" || userPhone === "" || userMessage === "") {
        alert("Please fill in all fields.");
        return false;
    }

    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(userEmail)) {
        alert("Invalid email address.");
        return false;
    }

    alert(`Thanks, ${fullName}! Your message has been sent.`);
    document.querySelector("form").submit();
}
