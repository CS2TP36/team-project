<?php

namespace App\Http\Emailers;

use App\Http\Emailers\Emailer;

class RegistrationEmailer extends Emailer
{
    // sends from registration@mail.sportswear.website
    public function __construct()
    {
        $this->name = 'registration';
    }
    // sends email for account creation
    public function sendRegistrationEmail($user): bool
    {
        $to = $user->email;
        $subject = 'SportsWear - Account Created';
        $message = 'Hello ' . $user->first_name . ', thank you for creating an account with SportsWear.';
        return $this->sendEmail($to, $subject, $message);
    }
}
