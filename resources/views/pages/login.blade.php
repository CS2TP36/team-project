<!DOCTYPE html>
<!--Specifying Language-->
<html lang = "en">
<head>
    <!--Specifying Character set-->
    <meta charset = "UTF-8"/>
    <meta name = "viewport" content = "width = device - width, initial-scale = 1.0">
    <title>Login</title>
</head>
<!-- Need to reference CSS-->
<body>
<div class = "login">
    <h2>Login</h2>
    <!-- Need to work out how to use form method with Laravel-->
    <form method = "post" action = "">
        Username: <input type = "text" name = "username" /><br>
        Password: <input type = "password" name = "password" /><br><br>
        <input type = "submit" value = "Login" />
        <input type = "reset" value = "Clear" />
        <!--Need to link to registeration page-->
        <p>Not registered yet?</p>
    </form>
</div>
</body>
</html>