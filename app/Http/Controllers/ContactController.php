<?php

namespace App\Http\Controllers;

use App\Http\Emailers\ContactEmailer;
use App\Models\ContactItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return back()->with('error', $th->getMessage());
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
            // only send email if the mailgun secret is set
            if (env('MAILGUN_SECRET')) {
                // sends a confirmation email
                $contactEmailer = new ContactEmailer();
                $contactEmailer->sendConfirmation($contactItem);
            }
        }
        return redirect('/home')->with('message', 'Thanks for contacting us!');
    }

    // a function to load the admin page
    public function show($page = 1) {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return back()->with('message', 'You do not have permission to see this page');
        }
        // determines the number of messages to show per page
        $perpage = 10;
        // gets all the contact items
        $contactItems = ContactItem::all();
        $number = $contactItems->count();
        // calculate total number of pages by rounding up
        $pages = ceil($number / $perpage);
        // reverse the order then get the 10 for the required page
        $contactItems = $contactItems->reverse()->skip(($page - 1) * $perpage)->take($perpage);
        return view('pages.admin.user-messages', ['contactItems' => $contactItems, 'pages' => $pages, 'page' => $page]);
    }
}
