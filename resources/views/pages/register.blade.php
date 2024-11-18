<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
</head>

<body>
<h2>Register to Become a Member</h2>
<form id="signupForm">
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required>

    <br> <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required placeholder="e.g., something@something.com">

    <br> <br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required minlength="8">

    <label for="confirmPassword">Confirm Password:</label>
    <input type="password" id="confirmPassword" name="confirmPassword" required>

    <br> <br>

    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" required pattern="^\+44\d{10,13}$" placeholder="e.g., +44 1234 567890">

    <br> <br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>

    <br> <br>

    <button type="submit">Sign Up</button>
</form>
</body>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        width: 100%;
        max-width: 500px;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .input-group {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    label {
        font-size: 14px;
        margin: 10px 0 5px;
        display: block;
    }

    input {
        width: calc(50% - 10px);
        padding: 8px;
        margin: 5px 0 15px;
        border: 1px solid #ddd;
        border-radius: 3px;
        box-sizing: border-box;
    }

    input[type="text"], input[type="email"], input[type="password"], input[type="tel"] {
        width: 100%;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 20px;
    }

    button:hover {
        background-color: darkred;
    }
</style>


