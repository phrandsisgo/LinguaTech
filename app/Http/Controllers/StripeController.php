<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StripeController extends Controller
{
    public function index()
    {
        return view('payments/stripe');
    }
    public function checkout()
    {
        if(app()->environment('production')){
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        } else {
            \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET'));
        }

            try{
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Basic Subscription Linguatech',
                        ],
                        'unit_amount' => 300, // 3.00 eur
                        'recurring' => [
                            'interval' => 'month',
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'success_url' => env('APP_URL') . '/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => env('APP_URL') . '/cancel',
                'customer_email' => auth()->user()->email,
                'client_reference_id' => auth()->user()->id,

            ]);
            return response()->json(['id' => $session->id]);
        } catch (\Exception $e) {
            dd ($e);
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    
    public function success(Request $request)
    {
        //dd the request
        //dd($request->all());
        $session_id = $request->get('session_id');
    
        if (!$session_id) {
            return view('payments/payment-failed');
        }
    
        \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET'));
    
        // Abrufen der Session von Stripe
        $session = \Stripe\Checkout\Session::retrieve($session_id);
    
        $user = auth()->user();
        if (!$user) {
            $user = User::find($session->client_reference_id);
        }
        //dd($user);
    
        // Speichere die Stripe-Kunden-ID und die Abonnement-ID
        $user->stripe_id = $session->customer; // Stripe-Kunden-ID
        $user->stripe_subscription_id = $session->subscription; // Stripe-Abonnement-ID
    
        // Abonnement-Daten abrufen
        $subscription = \Stripe\Subscription::retrieve($session->subscription);
    
        // Abonnement-Enddatum und Status speichern
        $user->subscribed_until = \Carbon\Carbon::createFromTimestamp($subscription->current_period_end); // Enddatum des Abos
        $user->subscription_status = $subscription->status; // Status des Abos (z.B. 'active', 'canceled')
    
        $user->save();
    
        $amount = '10.00 EUR';
        $subscriptionEndDate = $user->subscribed_until->format('Y-m-d');

        return view('payments/success-payment', [
            'user' => $user,
            'amount' => $amount,
            'subscriptionEndDate' => $subscriptionEndDate,
        ]);
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
