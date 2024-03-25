<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordList;
use App\Models\WordListWord;
use App\Models\User;
use App\Models\Word;

class WordListController extends Controller{
    public function library(){
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

    public function list_add_word(Request $request){
        //dd($request);
        //diese Funktion sollte so funktionieren, dass es im request ein base und target wort bekommt und noch eine WordlistID und dann sollte ein neuer Eintrag in der WordlistWord Tabelle erstellt werden und in die Wordlist auch.
        $request->validate([
            'baseWord' => 'required|min:1|max:50',
            'targetWord' => 'required|min:1|max:50',
        ]);
        $word = new Word;
        $word->base_word = $request->baseWord;
        $word->target_word = $request->targetWord;
        $word->base_language_id = 1;//muss noch zu einem späteren Zeitpunkt angepasst werden.
        $word->target_language_id = 2;//muss noch zu einem späteren Zeitpunkt angepasst werden.
        $word->word_list_id = $request->list;
        $word->save();
        $id=$request->list;
        $liste = WordList::find($id);
        return redirect('/list_show/'.$id);//redirect wird gar nicht gebraucht, da es ein event.preventDefault request ist.
    }

    public function list_update_function(Request $request, $id){
        $request->validate([
            'listTitle' => 'required|min:3|max:20',
            'baseWord.*' => 'required|min:1|max:50',
            'targetWord.*' => 'required|min:1|max:50',
            'listDescription' => 'max:200',
        ]);
        //dd($request);

        $liste = WordList::find($id);
        $baseWords = $request->baseWord;
        $targetWords = $request->targetWord;
        $wordIds = $request->wordIds;
    
        foreach ($wordIds as $index => $wordId) {
            if ($wordId === 'new') {
                $word = new Word;
                $word->base_word = $baseWords[$index];
                $word->target_word = $targetWords[$index];
                 $word->base_language_id = 1;
                $word->target_language_id = 2; 
                $word->word_list_id = $liste->id;
                $word->save();
            } else {
                $word = Word::find($wordId);
                if ($word) { // Stellen Sie sicher, dass das Wort gefunden wurde
                    $word->base_word = $baseWords[$index];
                    $word->target_word = $targetWords[$index];
                    $word->save();
                }
            }
        }
    
        $liste->name = $request->listTitle;
        $liste->description = $request->listDescription;
        $liste->save();
    
        return redirect('/library');
    }

    public function swipeLearn($id){
        $liste = WordList::with('words')->find($id);
        return view('swipeLearn',['liste' => $liste]);
    }

    public function list_create_function(Request $request){
        //diese Funktion sollte nicht nur eine Liste erstellen sondern auch die Wörter aus dem Formular in die Datenbank schreiben.
        $request->validate([
            'listTitle' => 'required|min:3|max:40',
            'baseWord.*' => 'required|min:1|max:50',
            'targetWord.*' => 'required|min:1|max:50',
            'listDescription' => 'max:200',
        ]);
    
        $liste = new WordList;
        $liste->name = $request->listTitle;
        $liste->description = $request->listDescription;
        $liste->created_by = auth()->user()->id;
        $liste->save();
    
        foreach ($request->baseWord as $index => $baseWord) {
            $word = new Word;
            $word->base_word = $baseWord;
            $word->target_word = $request->targetWord[$index];
            $word->base_language_id = 1; // muss noch zu einem späteren Zeitpunkt angepasst werden.
            $word->target_language_id = 2; // muss noch zu einem späteren Zeitpunkt angepasst werden.
            $word->word_list_id = $liste->id; // Setze den word_list_id auf die ID der neu erstellten WordList.
            $word->save();
    
        }
    
        return redirect('/library');
    }
    
    public function list_delete_function($id){
        $liste = WordList::find($id);
    
        // Prüfe, ob die Liste existiert
        if (!$liste) {
            // Optional: Füge eine Fehlermeldung hinzu, wenn die Liste nicht gefunden wurde
            return redirect('/library')->withErrors(['Die gesuchte Liste existiert nicht.']);
        }
    
        // Lösche alle Wörter, die zur Liste gehören
        foreach ($liste->words as $word) {
            $word->delete();
        }
    
        // Jetzt kann die Liste selbst gelöscht werden
        $liste->delete();
    
        return redirect('/library');
    }
    

    public function word_delete_function($id, $listId){
        $word = Word::find($id);
        $word->delete();
        return redirect('/list_show/'.$listId);
    }
    public function word_list_copy($id){
        dd($id);//zur Zeit wird dies noch nicht gebraucht.
        $liste = WordList::with('words')->find($id);
        return view('list_copy',['liste' => $liste]);
    }
    public function copyList($id){
        $liste = WordList::with('words')->find($id);
        if (!$liste) {
            // Optional: Rückmeldung geben, dass die Liste nicht gefunden wurde
            return redirect('/library')->withErrors('Liste nicht gefunden.');
        }
    
        $newList = $liste->replicate();
        $newList->created_by = auth()->user()->id;
        // Setze created_at und updated_at auf die aktuelle Zeit
        $newList->created_at = now();
        $newList->updated_at = now();
        $newList->save();
    
        foreach($liste->words as $word){
            $newWord = $word->replicate();
            $newWord->word_list_id = $newList->id;
            // Setze auch hier created_at und updated_at auf die aktuelle Zeit
            $newWord->created_at = now();
            $newWord->updated_at = now();
            $newWord->save();
        }
    
        return redirect('/library');
    }
    

    public function swipeHandle(Request $request){
        $request->validate([
            'wordId' => 'required',
            'direction' => 'required',
        ]);
        if ($request->direction == 'left') {
            //happens when the user swipes left
            $word = Word::find($request->wordId);
            $word->decreaseCountForAuthUser(1);
            return response()->json([
                'success' => 'success',
                'count' => $word->count(),
                'wordId' => $word->id
            ], 200);
        } elseif ($request->direction == 'right') {
            //happens when the user swipes right
            $word = Word::find($request->wordId);
            $word->increaseCountForAuthUser(1);
            return response()->json([
                'success' => 'success',
                'count' => $word->count(),
                'wordId' => $word->id
            ], 200);
        }else{
            return response()->json(['error' => 'false input(direction expected)'], 400);
        }
        $liste = WordList::with('words')->find($request->listId);
        $word = Word::find($request->wordId);
        $liste->words()->syncWithoutDetaching($word->id);
        return response()->json(['success' => 'success'], 200);
    }
}
