<?php

namespace App\Http;

use Mailgun\Mailgun;

// a class for sending emails
class Emailer
{
    public $name;
    // name goes to the sender address {name}@something
    function __construct($name)
    {
        $this->name = $name;
    }
    function sendEmail($to, $subject, $message): bool
    {
        try {
            // connect to mailgun API
            $mg = Mailgun::create(env('MAILGUN_SECRET'), "https://api.eu.mailgun.net");
            // send email
            $mg->messages()->send('mail.thesportswear.website', [
                'from' => $name . "mail.thesportswear.website",
                'to' => $to,
                'subject' => $subject,
                'text' => $message
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}
