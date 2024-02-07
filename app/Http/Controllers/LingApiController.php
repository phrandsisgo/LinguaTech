<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\WordList;
use App\Models\Text;

class LingApiController extends Controller
{
    public function translate(Request $request){
        //dd($request->all());
        $text = $request->input('word');
        $targetLang = 'DE'; // oder eine andere Sprache Ihrer Wahl

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . env('DEEPL_API_KEY'),
            //'Content-Type' => 'application/x-www-form-urlencoded'
        ])->post('https://api-free.deepl.com/v2/translate', [
            'text' => $text,
            'target_lang' => $targetLang,
            //'request_word' => $text
        ]);

        dd($response->json());
        $translation = $response->json()['translations'][0]['text'];

        return response()->json(['translation' => $translation, 'request' => $text]);
    }
    public function textPlay(){
        $ownLibraryList = WordList::where('created_by', auth()->user()->id)->get();
        $allTexts = Text::with("langOption")->get();

        return view('api-stuff/textPlay',['ownLibraryList' => $ownLibraryList, 'allTexts' => $allTexts]);
    }
    public function textShow($id){
        $text = Text::with("langOption")->find($id);
        $allTexts = Text::with("langOption")->get();
        $ownLibraryList = WordList::where('created_by', auth()->user()->id)->get();
        return view('api-stuff/textShow',['text' => $text, 'allTexts' => $allTexts, 'ownLibraryList' => $ownLibraryList]);
    }
    
    public function displayAllTexts(){
        $allTexts = Text::with("langOption")->get();
        return view('api-stuff/displayAllTexts',['allTexts' => $allTexts]);
    }
}
