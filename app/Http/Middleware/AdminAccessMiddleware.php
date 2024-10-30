<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //log datas for debugging
        Log::info('AdminAccessMiddleware: User ID - ' . $request->user()->id . ', Request - ' . json_encode($request->all()));
        //define user IDS that are allowed to access Filament
        $allowedUserIds = [1,9];
        //check if the user is allowed to access Filament
        if (Auth::check() && in_array(Auth::id(), $allowedUserIds)) {
            return $next($request);
        }
        //dd($request);
        abort(403, $request->user()->id . ' you are not allowed to access Filament');
    }
}
