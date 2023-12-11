<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LingApiController extends Controller
{
    public function translate(Request $request)
    {
        //dd($request->all());
        $text = $request->input('word');
        $targetLang = 'DE'; // oder eine andere Sprache Ihrer Wahl

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . env('DEEPL_API_KEY'),
            //'Content-Type' => 'application/x-www-form-urlencoded'
        ])->post('https://api-free.deepl.com/v2/translate', [
            'text' => $text,
            'target_lang' => $targetLang
        ]);

        //dd($response->json());
        $translation = $response->json()['translations'][0]['text'];

        return response()->json(['translation' => $translation]);
    }
}
