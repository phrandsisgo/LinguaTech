<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index()
    {
        return view('payments/stripe');
    }
    public function checkout()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Basic Subscription Linguatech',
                    ],
                    'unit_amount' => 1000, // 10.00 eur
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => env('APP_URL') . '/success',
            'cancel_url' => env('APP_URL') . '/cancel',
        ]);
        return response()->json(['id' => $session->id]);
    }
    public function success()
    {
        return view('payments/success-payment');
    }
    public function cancel()
    {
        return view('payments/cancel-payment');
    }
    public function checkSubscriptionStatus()
    {
        $user = auth()->user();

        // Überprüfen, ob der Benutzer ein aktives Abonnement hat
        if ($user->stripe_subscription_id) {
            \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET'));

            // Abrufen des Abonnements von Stripe
            $subscription = \Stripe\Subscription::retrieve($user->stripe_subscription_id);

            if ($subscription->status == 'active') {
                return 'active';
            } elseif ($subscription->status == 'canceled') {
                return 'canceled';
            }
        } else {
            return 'no_subscription';
        }
    }
}
