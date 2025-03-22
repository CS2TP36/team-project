<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Emailers\RegistrationEmailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create()
    {
        // Return the registration view
        return view('pages.register');
    }

    /**
     * Store a new user in the database.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|min:11|max:15',
            'address' => 'required|string|max:255',
        ]);

        // Create the user in the database
        $user = User::create([
            'first_name' => $validated['firstName'],
            'last_name' => $validated['lastName'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone_number' => $validated['phone'],
            'home_address' => $validated['address'],
            'postcode' => '', // You can add logic to handle the postcode if needed
            'role' => 'user', // Default role
        ]);
        // only send the email if the MAILGUN_SECRET is set
        if (env('MAILGUN_SECRET')) {
            // send an email to confirm account creation
            $mailer = new RegistrationEmailer();
            $mailer->sendRegistrationEmail($user);
        }

        // Redirect to the home page or a success page
        return redirect('/home')->with('message', 'Registration successful! Now you can log into your account.');
    }
}
