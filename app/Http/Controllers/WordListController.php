<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordList;
use App\Models\User;
use App\Models\Word;

class WordListController extends Controller{
    public function library(){
        //hier kann das Modell nicht gefunden werden.
        $libraryList = WordList::get();
        return view('library',['libraryList' => $libraryList]);
    }
    public function listShow($id){
        $liste = WordList::with('words')->find($id);
        // $begriffe = WordList::->getWordListById($id);
        return view('list_show',['liste' => $liste]);
    }
/*
    public function listShow($id){
        $begriffe = Word::with('base','target')->find($id);
        
        return view('list_show',['begriffe' => $begriffe]);
    }
*/
}
