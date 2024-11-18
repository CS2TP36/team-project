<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0 ,userscalable-no ">
    <title>Contact Me</title>
</head>
<body>

<div class="container">
    <div class="contactInfo">
        <div>
            <h2>Contact Info</h2>
            <ul class="info">
                <li>
                    <span><img src=""></span>
                    <span> becham Street<br>
                        90 <br>
                        b9020</span>
                    </span>
                </li>
                <li>
                    <span><img src=""></span>
                    <!-- <span>n@gmail.com</span> -->
                    <span><a href="n@gmail.com">n@gmail.com</a></span>
                </li>
                <li>
                    <span><img src=""></span>
                    <span>0121898919</span>
                </li>

            </ul>
        </div>


        <h1>Contact Me</h1>

        <form action="none">
            <label for="name">Full Name</label><br>
            <input type="text" name="name" id="name" placeholder="Name" required> <br>

            <label for="email">Your Email</label><br>
            <input type="email" name="email" id="email" placeholder="include@ " required> <br>

            <label for="subject">Contact Number</label><br>
            <input type="text" name="subject" id="subject" placeholder="+44" required> <br>

            <label for="country">Country</label>
            <select name="country" id="country">
                <option value="US">United States</option>
                <option value="GB">Great Britain</option>
                <option value="EURO">Europe</option>

            </select>
            <br>
            <label for="mesage">Message</label><br>
            <textarea name="message" id="message" cols="10" rows="7" placeholder="Start Typing Here "
                      required> </textarea> <br>
            <input type="submit" value="Submit">


            <input type="reset" value="erase all ">


        </form>

    </div class="social-media">
    <div class="contactInfo"></div>
    <h2>Follow Us</h2>
    <ul>
        <li><a href="https://www.facebook.com/"><img src="" alt="Facebook"></a></li>
        <li><a href="https://www.instagram.com/"><img src="" alt="Instagram"></a></li>
        <li><a href="https://twitter.com/"><img src="" alt="Twitter"></a></li>
        <li><a href="https://www.linkedin.com/"><img src="" alt="LinkedIn"></a></li>
    </ul>
    <label for="rating">Please Rate our Service</label><br>
    <input type="range" id="rating" name="rating" min="1" max="10" step="1">
</div>
</body>
</html>
