<?php

namespace App\Http\Controllers;

use App\Http\Emailers\ContactEmailer;
use App\Models\ContactItem;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // a function to receive ContactItems
    public function store(Request $request) {
        // Validate the request details
        try {
            $contactForm = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required'
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        if ($contactForm) {
            // creates a contact item
            $contactItem = new ContactItem([
                'name' => $contactForm['name'],
                'email' => $contactForm['email'],
                'phone' => $contactForm['phone'],
                'message' => $contactForm['message']
            ]);
            $contactItem->save();
            // sends a confirmation email
            $contactEmailer = new ContactEmailer();
            $contactEmailer->sendConfirmation($contactItem);
        }
        return redirect('/home')->with('message', 'Thanks for contacting us!');
    }
}
