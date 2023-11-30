<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mainController extends Controller
{
    public function index(){
        if (auth()->check()) {
            return redirect()->route('library');
        }else{
        return view('welcome');
        }
    }
    
}
