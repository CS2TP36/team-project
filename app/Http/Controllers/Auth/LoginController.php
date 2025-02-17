<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        $redirect = isset($credentials['redirect']) ? "/" . $credentials['redirect'] : '/home';
        
        unset($credentials['redirect']);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            Log::info('User Logged In:', ['id' => Auth::id(), 'email' => Auth::user() ? Auth::user()->email : 'N/A']);
            
            session(['user_id' => Auth::id()]);
            session()->save();
            
            return redirect()->intended($redirect)->with('success', 'Login successful!');
        }

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
        
        session()->forget('user_id');
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully!');
    }

    /**
     * Controller to get the login page.
     */
    public function show($redirect = 'account') 
    {
        if (Auth::check()) {
            return redirect($redirect);
        }
        
        return view('pages.login', ['redirect' => $redirect]);
    }
}
