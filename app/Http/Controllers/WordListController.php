<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordList;
use App\Models\User;


class WordListController extends Controller{
    public function library(){
        //hier kann das Modell nicht gefunden werden.
        $libraryList = WordList::get();
        return view('library',['libraryList' => $libraryList]);
    }
}
