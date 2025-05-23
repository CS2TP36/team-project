<?php

namespace App\Http\Emailers;

use App\Models\ContactItem;

// a class for sending the confirmation email for contact form
class ContactEmailer extends Emailer
{
    public function __construct()
    {
        $this->name = 'support';
    }
    // constructs and sends the confirmation email based on provided contactItem
    public function sendConfirmation(ContactItem $contactItem): bool
    {
        // set all the details for the email
        $to = $contactItem->email;
        $subject = 'SportsWear - Thanks for contacting us!';
        $message = 'Hello ' . $contactItem->name . ', we have received your message and will get back to you as soon as possible. Your message: ' . $contactItem->message;
        // send the email
        if ((!str_contains($message, "http")) and (!str_contains($message, "www")) and (!str_contains($message, ".ru"))) {
            return $this->sendEmail($to, $subject, $message);
        }
        return true;
    }

}
