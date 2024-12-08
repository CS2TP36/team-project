@extends('layouts.page')
@section('title')
    Login
@endsection
@section('content')
    <div class="login">
        <h2>Login</h2>

        <div class="login-sections">
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
                <!--
                <a href="/forgot-pass"><p>Forgotten your password?</p></a>
                -->
            </div>

            <div class="new-customers">
                <h3>New to SportsWear?</h3>
                <form>
                    <p>✓ Manage your orders and preferences.</p>
                    <p>✓ Access your personal wishlist.</p>
                    <p>✓ Basket saves added items.</p>
                    <p>✓ Instant access to your acount.</p>
                    <a href="/register"><button type="button">Register today</button></a>
                </form>
            </div>
        </div>
    </div>
@endsection
