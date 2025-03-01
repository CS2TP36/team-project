<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    // to show the discount code creation page
    function show() {
        return view('pages.admin.discount-codes');
    }
    // to add the new code to the database
    function add(Request $request) {
        // validate the request
        $request->validate([
            'start' => 'required|date',
            'expiry' => 'required|date',
            'code' => 'required|string',
            'percent_off' => 'required|numeric'
        ]);
        // create a new discount code
        $discount = new DiscountCode([
            'start' => $request->start,
            'expiry' => $request->expiry,
            'code' => $request->code,
            'percent_off' => $request->percent_off
        ]);
        // save it then return
        $discount->save();
        return redirect('/admin/account')->with('message', 'Discount code added');
    }
}
