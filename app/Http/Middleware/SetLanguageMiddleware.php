<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }else{
            $preferredLanguage = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            if($preferredLanguage === 'de' ) {
                App::setLocale('de');
                Session::put('locale', 'de');
            //} elseif ($preferredLanguage === 'en') {
            } else {
                App::setLocale('en');
                Session::put('locale', 'en');
            }
        }
        return $next($request);
    }
}
