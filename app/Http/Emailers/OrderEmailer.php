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
        $shipping = $order->shipping;
        $to = $order->user->email;
        $subject = 'SportsWear - Order Confirmed - #' . $order->id;
        $message = 'Hello ' . $order->user->first_name . ', we have received your order. Order id: ' . $order->id. '. Tracking number: ' . $shipping->tracking_number;
        return $this->sendEmail($to, $subject, $message);
    }
}
