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
        $liste = WordList::find($id);
        $baseWords = $request->baseWord;
        $targetWords = $request->targetWord;
        $wordIds = $request->wordIds;
    
        foreach ($wordIds as $index => $wordId) {
            if ($wordId === 'new') {
                $word = new Word;
                $word->base_word = $baseWords[$index];
                $word->target_word = $targetWords[$index];
                /* $word->base_language_id = 1;
                $word->target_language_id = 2; */
                $word->save();
                $liste->words()->attach($word->id);
            } else {
                $word = Word::find($wordId);
                if ($word) { // Stellen Sie sicher, dass das Wort gefunden wurde
                    $word->base_word = $baseWords[$index];
                    $word->target_word = $targetWords[$index];
                    $word->save();
                    $liste->words()->syncWithoutDetaching($word->id);
                }
            }
        }
    
        $liste->name = $request->listTitle;
        $liste->description = $request->listDescription;
        $liste->save();
    
        return redirect('/library');
    }

    public function list_create_function(Request $request){
        //diese Funktion sollte nicht nur eine Liste erstellen sondern auch die Wörter aus dem Formular in die Datenbank schreiben.
        //und dann auch die dazugehöriegen Verknüpfungen in der many-to-many Tabelle erstellen.
        //dd($request);
        $liste = new WordList;
        $liste->name = $request->listTitle;
        $liste->description = $request->listDescription;
        $liste->created_by = 1;
        $liste->save();

        foreach ($request->baseWord as $index => $baseWord) {
            $word = new Word;
            $word->base_word = $baseWord;
            $word->target_word = $request->targetWord[$index];
            $word->base_language_id = 1;
            $word->target_language_id = 2;
            $word->save();
            $liste->words()->attach($word->id);
        }
        return redirect('/library');
    }

    public function list_delete_function($id){
        $liste = WordList::find($id);
        $liste->delete();
        return redirect('/library');
    }
    
}
