@extends('layouts.page')
    @section('title')
    Login
    @endsection
@section('content')
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

<style>
.login {
    background-color: #757474;
    display: block;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin: 50px;
    padding: 15px;
    color: white;
    h2 {
        font-family:sans-serif;
        color: white;
        font-size: 40px;
    }
}
</style>
@endsection