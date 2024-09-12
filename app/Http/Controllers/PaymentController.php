<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function charge(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = 5000; 

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Example Charge',
            ]);

            return back()->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
