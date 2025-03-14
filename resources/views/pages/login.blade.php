@extends('layouts.page')
@section('title')
    Login
@endsection
@section('content')
    <div class="login">
        <!-- Split into existing and new customers to keep code organised-->
        <div class="login-sections">
            <div class="existing-customers">
                <h2>Login</h2>
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
                    <div class="login-label"><label for="email">Email *</label><br></div>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required/><br>
                    <div class="login-label"><label for="password">Password *</label><br></div>
                    <input type="password" id="password" name="password" required/><br>
                    <input type="hidden" name="redirect" id="redirect" value="@if(isset($redirect)){{$redirect}}@endif"/>
                    <button type="submit">Sign In</button>
                </form>
                <a href="/forgot-pass"><p>Forgotten your password?</p></a>
            </div>

            <div class="new-customers">
                <h3>New to SportsWear?</h3>
                <form>
                    <p>✓ Manage your orders and preferences.</p>
                    <p>✓ Access your personal wishlist.</p>
                    <p>✓ Basket saves added items.</p>
                    <p>✓ Instant access to your acount.</p>    
                </form>
                <a href="/register">Register today</a>
            </div>
        </div>
    </div>
@endsection
