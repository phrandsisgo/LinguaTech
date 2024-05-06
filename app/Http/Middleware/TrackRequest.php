<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tracker;

class TrackRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Protokollieren der Anfrage
        $tracker = new Tracker();
        $tracker->ip_address = $request->ip();
        $tracker->route = $request->getPathInfo();
        $tracker->user_id = auth()->id(); // Falls ein Benutzer angemeldet ist, ansonsten NULL
        $tracker->save();

        return $next($request);
    }
}
