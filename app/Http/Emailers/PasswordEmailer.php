<?php

namespace App\Http\Emailers;

use App\Http\Emailers\Emailer;

class PasswordEmailer extends Emailer
{
    // sends from account@mail.sportswear.website
    public function __construct()
    {
        $this->name = 'account';
    }
    // sends email for password change
    public function sendPasswordChange($user, $newpass): bool
    {
        $to = $user->email;
        $subject = 'SportsWear - Password Reset';
        $message = 'Hello ' . $user->first_name . ', your password has been reset. Your new password is: ' . $newpass . '        Please login and change your password as soon as possible.';
        return $this->sendEmail($to, $subject, $message);
    }
}
