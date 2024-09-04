<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\WordList;
use App\Models\Text;
use App\Models\LangOption;

class LingApiController extends Controller
{
    public function translate(Request $request){
        //dd($request->all());
        $text = $request->input('word');
        $targetLang = $request->input('targetLang');
        $sourceLang = $request->input('baseLang');

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . env('DEEPL_API_KEY'),
            //'Content-Type' => 'application/x-www-form-urlencoded'
        ])->post('https://api-free.deepl.com/v2/translate', [
            'text' => $text,
            'target_lang' => $targetLang,
            'source_lang' => $sourceLang,
        ]);

        //dd($response->json());
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
    public function destroyText(Request $request,){
        $id = $request->input('textId');
        $text = Text::find($id);
        if (!$text) {
            return redirect()->back()->with('error', 'Text not found.');
        }
        $text->delete();
        return redirect()->route('displayAllTexts')->with('success', 'Text deleted successfully.');
    }
    
    public function displayAllTexts(){
        $allTexts = Text::with("langOption")->get();
        return view('api-stuff/displayAllTexts',['allTexts' => $allTexts]);
    }
    public function addText(){
        $languages = LangOption::all();
        return view('api-stuff/newText',['languages' => $languages]);
    }
    //wurde noch nicht getestet:
    public function createNewText(Request $request){
        $text = new Text();
        $text->title = $request->input('title');
        $text->text = $request->input('add-text-field');
        $text->lang_option_id = $request->input('lang')[0];
        $text->created_by = auth()->user()->id;
        $text->save();
        $text_id = $text->id;
        return redirect('/textShow/'.$text_id);
    }
}
