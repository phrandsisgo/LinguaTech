<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Text;
use App\Models\LangOption;
use App\Models\WordList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TextController extends Controller
{
    public function index()
    {
        $texts = Text::with('langOption')->get();
        return response()->json($texts);
    }

    public function show($id)
    {
        $text = Text::with('langOption')->findOrFail($id);
        return response()->json([
            'text' => $text,
            'allTexts' => Text::with('langOption')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'text'  => 'required|string',
            'lang_option_id' => 'required|integer',
        ]);
        $text = Text::create([
            'title' => $request->title,
            'text'  => $request->input('text'),
            'lang_option_id' => $request->lang_option_id,
            'created_by' => Auth::id(),
        ]);
        return response()->json($text, 201);
    }

    public function update(Request $request, $id)
    {
        $text = Text::findOrFail($id);
        if ($text->created_by !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $text->update($request->only('title', 'text', 'lang_option_id'));
        $text->updated_at = now();
        $text->save();
        return response()->json($text);
    }

    public function destroy($id)
    {
        $text = Text::findOrFail($id);
        if ($text->created_by !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $text->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'title'           => 'required|string',
            'description'     => 'required|string',
            'lang_option_id'  => 'required|integer',
            'deck_id'         => 'nullable',
        ]);
        // Delegate to existing LingApiController logic
        $ctrl = app(\App\Http\Controllers\LingApiController::class);
        $req = new \Illuminate\Http\Request([
            'title'           => $request->title,
            'add-text-field'  => $request->description,
            'lang_option_id'  => $request->lang_option_id,
            'deck_id'         => $request->deck_id,
        ]);
        $ctrl->generateText($req);
        // Return the created text
        $latest = Text::where('created_by', Auth::id())->orderByDesc('id')->first();
        return response()->json($latest, 201);
    }

    public function translate(Request $request)
    {
        $request->validate([
            'word'       => 'required|string',
            'targetLang' => 'required|string',
            'baseLang'   => 'required|string',
            'context'    => 'nullable|string',
        ]);
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . env('DEEPL_API_KEY'),
        ])->post('https://api-free.deepl.com/v2/translate', [
            'text'        => $request->word,
            'target_lang' => $request->targetLang,
            'source_lang' => $request->baseLang,
            'context'     => $request->context,
        ]);
        return response()->json([
            'translation' => $response->json()['translations'][0]['text'] ?? null,
            'request'     => $request->word,
        ]);
    }
}
