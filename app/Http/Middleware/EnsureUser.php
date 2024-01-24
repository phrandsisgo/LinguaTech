<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Word;


class EnsureUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $word = Word::find($request->id);
        // Überprüfe, ob das Wort existiert und ob der angemeldete Benutzer der Besitzer ist
        if (!empty($word) && $word->user_id == Auth::id()) {
            return $next($request);
        }

        // Redirect oder Fehlermeldung, falls nicht berechtigt
        return redirect('/')->with('error', 'Unberechtigter Zugriff!');
    }
}
