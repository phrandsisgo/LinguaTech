<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TranslateController extends Controller
{
    public function translate(Request $request): JsonResponse
    {
        $request->validate([
            'word' => 'required|string',
            'targetLang' => 'required|string',
            'baseLang' => 'nullable|string',
        ]);

        $text = $request->input('word');
        $targetLang = $request->input('targetLang');
        $sourceLang = $request->input('baseLang');
        $context = $request->input('context');

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . env('DEEPL_API_KEY'),
        ])->post('https://api-free.deepl.com/v2/translate', [
            'text' => $text,
            'target_lang' => $targetLang,
            'source_lang' => $sourceLang,
            'context' => $context,
        ]);

        $translation = $response->json()['translations'][0]['text'];

        return response()->json(['translation' => $translation, 'request' => $text]);
    }
}
