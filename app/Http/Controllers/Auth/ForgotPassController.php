<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Emailers\PasswordEmailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            $user = User::all()->where('email', $validated['email'])->first();
            // check if the user exists
            if ($user) {
                try {
                    // check if the initials are correct
                    $firstInitial = strtoupper(substr($user->first_name, 0, 1));
                    $lastInitial = strtoupper(substr($user->last_name, 0, 1));
                    if ($firstInitial == $validated['firstInitial'] && $lastInitial == $validated['lastInitial']) {
                        // generate a new random password
                        $newPass = bin2hex(random_bytes(32));
                        $hashed = Hash::make($newPass);
                        // send the email
                        $mailer = new PasswordEmailer();
                        if ($mailer->sendPasswordChange($user, $newPass)) {
                            // update the user with the new password
                            $user->password = $hashed;
                            $user->save();
                            // redirect to home with a message
                            return redirect('/home')->with('message', 'Please check your email to continue');
                        }
                    }
                } catch (\Exception $exception) {
                    // return back with errors if something went wrong
                    return back()->withErrors('passChange', 'Something went wrong');
                }
            }
        }
        // return back with errors if something went wrong
        return back()->withErrors('passChange', 'Something went wrong');
    }
}
