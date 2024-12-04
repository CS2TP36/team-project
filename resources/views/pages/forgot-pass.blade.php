@extends('layouts.page')
@section('title', 'Forgot-pass')
@section('content')

<div class="Forgot-Pass">
        <h2>Reset Your Password</h2>

        <div class="reset-sections">
            <div class="">
                <h3>Forgot your password? Please enter your email address below: </h3>

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
                

                    <button type="submit">Sign In</button>
                </form>
            </div>
                </form>
            </div>
        </div>
    </div>

    @endsection