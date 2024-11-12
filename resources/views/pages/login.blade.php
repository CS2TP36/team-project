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
@endsection