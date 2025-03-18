<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    // shows discount creation page
    function show() {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return back()->with('message', 'You do not have permission to access this page');
        }
        return view('pages.admin.discount-codes');
    }
    // to add the new code to the database
    function add(Request $request) {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return back()->with('message', 'You do not have permission to add a discount');
        }
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

    public function ajaxCheckDiscount(Request $request)
    {
        $code = $request->query('code'); 
        $discount = DiscountCode::where('code', $code)->first();

        // If code not found or invalid, return JSON with valid=false
        if (!$discount || !$discount->isValid()) {
            return response()->json([
                'valid' => false,
                'error' => 'Invalid or expired code.'
            ], 200);
        }

        // Otherwise, return the exact discount percentage
        return response()->json([
            'valid'       => true,
            'percent_off' => $discount->percent_off,
        ], 200);
    }
}
