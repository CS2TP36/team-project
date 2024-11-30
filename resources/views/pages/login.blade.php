@extends('layouts.page')
@section('title')
    Login
@endsection
@section('content')

    <div class="login">
        <h2>Login</h2>

        <div class="existing-customers">
            <h3>Existing Customers</h3>

            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="error-message">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login.authenticate') }}">
                @csrf 

                <label for="email">Email *</label><br>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required/><br>
                
                <label for="password">Password *</label><br>
                <input type="password" id="password" name="password" required/><br>
                
                <button type="submit">Sign In</button>
            </form>
            <a href="#"><p>Forgotten your password?</p></a>
        </div>

        <div class="new-customers">
            <h3>New to SportsWear?</h3>
            <form>
                <p>Line 1 ------------------------------------------------</p>
                <p>Line 2 ------------------------------------------------</p>
                <p>Line 3 ------------------------------------------------</p>
                <p>Line 4 ------------------------------------------------</p>
                <p>Line 5 ------------------------------------------------</p>
                <a href="/register"><button type="button">Register today</button></a>
            </form>
        </div>
    </div>

@endsection
