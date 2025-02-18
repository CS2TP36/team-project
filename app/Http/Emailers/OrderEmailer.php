<?php

namespace App\Http\Emailers;

use App\Http\Emailers\Emailer;

// a class for sending order confirmation emails
class OrderEmailer extends Emailer
{
    // sends from order@mail.sportswear.website
    public function __construct()
    {
        $this->name = 'order';
    }

    // sends email for given order
    public function sendOrderConfirmation($order): bool
    {
        $to = $order->email;
        $subject = 'SportsWear - Order Confirmed - #' . $order->id;
        $message = 'Hello ' . $order->user->name . ', we have received your order and will get back to you as soon as possible. Your order: ' . $order->order;
        return $this->sendEmail($to, $subject, $message);
    }
}
