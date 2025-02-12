<?php

namespace App\Http\Emailers;

use Mailgun\Mailgun;

// a class for sending emails
class Emailer
{
    public string $name;
    // name goes to the sender address {name}@something
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function sendEmail($to, $subject, $message): bool
    {
        try {
            // connect to mailgun API (need to put api key in the .env file)
            $mg = Mailgun::create(env('MAILGUN_SECRET'), "https://api.eu.mailgun.net");
            // send email
            $mg->messages()->send('mail.thesportswear.website', [
                'from' => $this->name . "@mail.thesportswear.website",
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
