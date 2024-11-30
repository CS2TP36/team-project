<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0 ,userscalable-no">
    <link rel="stylesheet" href="contactstyle.css">
    <title>Contact Me</title>

    <script>  //javascript
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
        }
    </script>
</head>
<body>
    <div class="banner">
        <h1>Contact Us - We're here to help!</h1>  //this is my contact us page 
    </div>

    <div class="container">
        <div class="contactInfo"> 
            <div>
                <h2>Contact Info</h2>
                <ul class="info">
                    <li>
                        <strong>Address:</strong><br>
                        Aston Street<br>
                        90<br>
                        B9020
                    </li>
                    <li>
                        <strong>Email:</strong><br>
                        <a href="mailto:sportwear@gmail.com">sportwear@gmail.com</a>
                    </li>
                    <li>
                        <strong>Phone:</strong><br>
                        0121 898 919
                    </li>
                </ul>
            </div>
            
            <h1>Contact Me</h1>

            <form action="none" onsubmit="validateContactForm(event)">

                <label for="name">Full Name</label><br>
                <input type="text" name="name" id="name" placeholder="Full Name" required><br>

                <label for="email">Your Email</label><br>
                <input type="email" name="email" id="email" placeholder="include@" required><br>

                <label for="subject">Contact Number</label><br> 
                <input type="text" name="subject" id="subject" placeholder="+44" required><br>

                <label for="country">Country</label>
                <select name="country" id="country">
                    <option value="US">United States</option>
                    <option value="GB">Great Britain</option>
                    <option value="EURO">Europe</option>
                </select>
                <br>

                <label for="message">Message</label><br>
                <textarea name="message" id="message" cols="10" rows="7" placeholder="Start Typing Here" required></textarea><br>

                <input type="submit" value="Submit">
                <input type="reset" value="Erase All">
            </form>
        </div>

        <div class="social-links">
            <h2>Follow Us</h2>
            <ul>
                <li><a href="https://www.facebook.com/"><img src="images/111.png" alt="Facebook"></a></li>
                <li><a href="https://www.instagram.com/"><img src="images/instagram-logo-transparent-background-2.png" alt="Instagram"></a></li>
                <li><a href="https://twitter.com/"><img src="images/R.png" alt="Twitter"></a></li>
                <li><a href="https://www.linkedin.com/"><img src="images/linkedIn_PNG8.png" alt="LinkedIn"></a></li>
            </ul>
            <label for="rating">Please Rate our Service</label><br>
            <input type="range" id="rating" name="rating" min="1" max="10" step="1">
        </div>
    </div>
</body>
</html>
