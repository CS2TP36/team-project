<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForgotPassController extends Controller
{
    // function to laod the page
    function show()
    {
        // dont show page if already logged in
        if (Auth::check()) {
            return redirect('/home')->with('message', 'You are already logged in');
        }
        return view('pages.forgot-pass');
    }
    // function to generate a random password and send the required email
    function change(Request $request)
    {
        // dont do anything if they already logged in
        if (Auth::check()) {
            return redirect('/home')->with('message', 'You are already logged in');
        }
        // validate the email and initials
        $validated = $request->validate([
            'email' => 'required|email',
            'firstInitial' => 'required|string|size:1',
            'lastInitial' => 'required|string|size:1',
        ]);
        if ($validated) {
            // will need to actually do the stuff here, just giving message for now
            return redirect('/home')->with('message', 'Please check your email to continue');
        }
        // return back with errors if something went wrong
        return back()->withErrors('passChange', 'Something went wrong');
    }
}
