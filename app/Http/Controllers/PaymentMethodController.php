<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index()
{
    if (!Auth::check()) {
        return redirect()->route('login.show')->with('message', 'Please login first.');
    }

    $payments = PaymentMethod::where('user_id', Auth::id())->get();
    return view('pages.account-payments', compact('payments'));
}
    public function create() {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        return view('pages.newpaymentpage');
    }

    public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login.show')->with('message', 'Please login first.');
    }

    $request->validate([
        'card_number'  => 'required|string|max:19',
        'expiry_month' => 'required|string|max:2',
        'expiry_year'  => 'required|string|max:2',
        'card_name'    => 'required|string|max:255',
        'card_cvc'     => 'required|string|max:4',
        'is_default'   => 'sometimes|boolean',
    ]);

    if ($request->boolean('is_default')) {
        PaymentMethod::where('user_id', Auth::id())->update(['is_default' => false]);
    }

    PaymentMethod::create([
        'user_id'      => Auth::id(),
        'card_number'  => $request->card_number,
        'expiry_month' => $request->expiry_month,
        'expiry_year'  => $request->expiry_year,
        'card_name'    => $request->card_name,
        'cvv'     => $request->card_cvc,
        'is_default'   => $request->boolean('is_default', false),
    ]);

    return redirect()->route('account.payments')->with('success', 'Payment method successfully added.');
}

    public function edit($id) {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        $paymentMethod = PaymentMethod::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('pages.Edit_Payment', compact('paymentMethod'));
    }

    public function update(Request $request, $id) {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        $request->validate([
            'card_number' => 'required|string|max:16',
            'card_name' => 'required|string|max:255',
            'expiry_month' => 'required|string|max:2',
            'expiry_year' => 'required|string|max:2',
            'cvv' => 'required|string|max:4',
            'is_default' => 'sometimes|boolean'
        ]);

        $paymentMethod = PaymentMethod::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($request->boolean('is_default')) {
            PaymentMethod::where('user_id', Auth::id())->update(['is_default' => false]);
            $paymentMethod->is_default = true;
        }

        $paymentMethod->update([
            'card_number' => $request->card_number,
            'card_name' => $request->card_name,
            'expiry_month' => $request->expiry_month,
            'expiry_year' => $request->expiry_year,
            'cvv' => $request->cvv,
        ]);

        return redirect()->route('account.payments')->with('success', 'Payment method updated successfully.');
    }

    public function destroy($id) {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        $paymentMethod = PaymentMethod::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $paymentMethod->delete();

        return redirect()->route('account.payments')->with('success', 'Payment method deleted successfully.');
    }
}
