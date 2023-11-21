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
        return view('list_show',['liste' => $liste]);
    }
    public function listLoad($id){
        $liste = WordList::with('words')->find($id);
        return view('list_update',['liste' => $liste]);
    }

    public function list_update_function(Request $request, $id){
        //dd($request);
        $liste = WordList::find($request->id);
        $baseWords = $request->baseWord;
        $targetWords = $request->targetWord;
        $wordIds = $request->wordIds;
        foreach ($wordIds as $index => $wordId) {
            if ($wordId === 'new'){
                $word = new Word();
                $word->save();
                $liste->words()->attach($word->id);
            }else {
                
                $word = Word::find($wordId);
                if(!$word){
                    $word->base_word = $baseWords[$index];
                    $word->target_word = $targetWords[$index];
                    $word->save();
                }
            $liste->words()->syncWithoutDetaching($word->id);
            }
        }
        $liste->name = $request->listTitle;
        $liste->description = $request->listDescription;
        $liste->save();
        return redirect('/library');
    }
/*
    public function listShow($id){
        $begriffe = Word::with('base','target')->find($id);
        
        return view('list_show',['begriffe' => $begriffe]);
    }
*/
}
