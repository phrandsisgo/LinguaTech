<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LanguageController extends Controller
{
    public function changeLanguage( $lang){
        
        App::setLocale($lang);
        session(['locale' => $lang]);
        if (Auth::check()) {
            $user = Auth::user();
            $user->language = $lang;
            $user->save();
        }
        return redirect()->back();
    }
}
