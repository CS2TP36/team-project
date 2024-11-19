@extends('layouts.page')
@section('title')
    Login
@endsection
@section('content')
    
    <div class="login">
        <body>
        <h2>Login</h2>
        <!-- Need to work out how to use form method with Laravel-->
        <form method="post" action="">
            Username: <input type="text" name="username"/><br>
            Password: <input type="password" name="password"/><br><br>
            <input type="submit" value="Login"/>
             <!--Links to registeration page-->
            <a href="/register"><input type="register" value="Register"/></a>
        </form>
        </body>
    </div>
@endsection
