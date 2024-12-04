<?php

namespace App\Http\Controllers;

use App\Models\ContactItem;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // a function to receive ContactItems
    public function store(Request $request) {
        // Validate the request details
        $contactForm = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        ]);
        if ($contactForm) {
            // creates a contact item
            $contactItem = new ContactItem([
                'name' => $contactForm['name'],
                'email' => $contactForm['email'],
                'phone' => $contactForm['phone'],
                'message' => $contactForm['message']
            ]);
            $contactItem->save();
        }
        return back();
    }
}
