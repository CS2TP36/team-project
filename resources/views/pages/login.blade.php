@extends('layouts.page')
@section('title')
    Login
@endsection
@section('content')
<body>    
    <div class="login">
        <h2>Login</h2>

        <div class= "existing-customers">
            <h3>Existing Customers</h3>
            <form>
                <label for="username">Username *</lable><br>
                <input type="text" id="username" name="username" required/><br>
                
                <label for="password">Password *</lable><br>
                <input type="password" id="password" name="password" required/><br>
                
                <buton type="submit">Sign In</button>
            </form>    
            <a href="#">Forgotten your password?</a>
        </div>

        <div class= "new-customers">
            <h3>New to SportsWear?</h3>
            <form>
                <p>Line 1 ------------------------------------------------</p>
                <p>Line 2 ------------------------------------------------</p>
                <p>Line 3 ------------------------------------------------</p>
                <p>Line 4 ------------------------------------------------</p>
                <p>Line 5 ------------------------------------------------</p>
                <a href="/register"><buton type="button">Register today</button></a>
            </form>    
        </div>
    </div>

</body>
@endsection
