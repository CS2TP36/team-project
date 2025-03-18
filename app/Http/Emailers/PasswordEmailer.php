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
        if ($this->sendEmail($to, $subject, $message)) {;
            // also send a notification email
            return $this->sendPasswordChangeNotification($user);
        }
        return false;
    }

    public function sendPasswordChangeNotification($user): bool
    {
        $to = $user->email;
        $subject = 'SportsWear - Password Change Notification';
        $message = 'Hello ' . $user->first_name . ', your password has been changed. If this was not you, please contact us via the contact page, stating your account id: ' . $user->id . ' and we will investigate.';
        return $this->sendEmail($to, $subject, $message);
    }
}
