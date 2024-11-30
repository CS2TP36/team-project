function validateContactForm(event) {
    event.preventDefault();

    const fullName = document.getElementById('Fullname').value.trim();

    const userEmail = document.getElementById('email').value.trim();

    const userPhone = document.getElementById('Phone').value.trim();

    const userMessage = document.getElementById('message').value.trim();

    if (fullName === "") {
        alert("sorry ! Your Full Name Has Not Been Provided ");
        return false;
    }

    const emailRegex = /^[^ ]+@[^ ]+\.[a-z]{2,6}$/;
    if (!userEmail.match(emailRegex)) {
        alert("unvalid email addres .Please double-check .");
        return false;
    }

    let phoneRegex; //i got 3 countries chnage so ech country is different

    const userCountry = document.getElementById('country').value;


    if (userCountry === "GB") {
        phoneRegex = /^[+]?[0-9]{11}$/;
        if (!userPhone.match(phoneRegex)) {
            alert(" Should be 11 digits ,Please try again.");
            return false;
        }
    } else if (userCountry === "US") {
        phoneRegex = /^[+]?[0-9]{10}$/;
        if (!userPhone.match(phoneRegex)) {
            alert("Should be 10 digits ,Please try again.");
            return false;
        }
    } else if (userCountry === "EURO") {
        phoneRegex = /^[+]?[0-9]{9,15}$/;
        if (!userPhone.match(phoneRegex)) {
            alert("This should be between 9 and 15 digits , Please try again");
            return false;
        }
    }

    if (userMessage === "") {
        alert("Don't forget to include a message, we would love to hear your query.");
        return false;
    }

    alert(`Thank you, ${fullName}! Your message has been sent.`);
    document.querySelector("form").submit();
