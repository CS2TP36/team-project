@extends('layouts.page')
@section('title', 'Forgot-pass')
@section('content')

<div class="reset">
        <h2>Reset Your Password</h2>

        <div class="reset-sections">
            <div class= "existing-customers">
                <h3>Forgot your password? Please enter your email address below: </h3>

                    <div class="error-messages">
                    </div>

                    <div class="error-message">
                    </div>

                <form method="POST" action="">

                    <label for="email">Email *</label><br>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required/><br>
                

                    <button type="submit">Submit Email</button>
                </form>
            </div>
                </form>
            </div>
        </div>
    </div>

    @endsection