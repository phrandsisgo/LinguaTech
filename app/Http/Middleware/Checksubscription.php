<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class Checksubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        //dd($user);
        if (!$user || !$user->subscribed_until || Carbon::parse($user->subscribed_until)->isPast()) {
            // Optionally, could also redirect to a CTA for the user to subscribe
            abort(403, 'FORBIDDEN / You are not subscribed.');
        }
        return $next($request);
    }
}
