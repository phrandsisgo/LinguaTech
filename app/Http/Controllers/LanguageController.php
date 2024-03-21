<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class LanguageController extends Controller
{
    public function changeLanguage(Request $request, $lang){
        App::setLocale($lang);
        Session()->put('locale', $lang);
        if (auth()->check()){
            auth()->user()->update(['language' => $lang]);
        }
        return redirect()->back();
    }
}
