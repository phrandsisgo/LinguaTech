<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Subscription extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();
        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    public function cancelSubscription(Request $request)
    {
        $user = $request->user();

        // Abo in Stripe kündigen
        if ($user->subscription('default')) {
            $user->subscription('default')->cancel();

            // Abonnement weiterhin bis zum "subscribed_until"-Datum erlauben
            $user->subscribed_until = now()->addMonth(); // Ein Monat zusätzlich
            $user->save();
        }

        return redirect()->route('profile.edit')->with('status', 'Abo gekündigt. Du kannst es bis zum bezahlten Datum weiter nutzen.');
    }
}