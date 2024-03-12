<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class LanguageController extends Controller
{
    public function changeLanguage($lang){
        App::setLocale($lang);
        Session()->put('locale', $lang);
        return redirect()->back();
    }
}
