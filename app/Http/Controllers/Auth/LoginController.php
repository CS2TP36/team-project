<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Authenticate the user.
     */
    public function authenticate(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'redirect' => 'string|nullable',
        ]);
        // get the redirect from the request
        if(isset($credentials['redirect'])) {
            $redirect = "/" . $credentials['redirect'];
        } else {
            $redirect = '/home';
        }
        // remove redirect from credentials before auth check
        unset($credentials['redirect']);
        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // redirect to specified page
            return redirect()->intended($redirect)->with('success', 'Login successful!');

        }

        // Return back with an error if authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    /**
     * Log out the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully!');
    }

    // controller to get the login page
    public function show($redirect = 'account') {
        // just redirect if already logged in
        if (Auth::check()) {
            return redirect($redirect);
        }
        // return the login page with redirect in session
        return view('pages.login', ['redirect' => $redirect]);
    }
}
