<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index()
    {
        return view('stripe');
    }
    public function checkout()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'ProduktName',
                    ],
                    'unit_amount' => 2000, // 20.00 eur
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => env('APP_URL') . '/success',
            'cancel_url' => env('APP_URL') . '/cancel',
        ]);
    }
    public function success()
    {
        return view('success-payment');
    }
    public function cancel()
    {
        return view('cancel-payment');
    }
}
