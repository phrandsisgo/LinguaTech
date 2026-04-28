<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WordList;
use App\Models\Word;
use App\Models\LangOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WordListController extends Controller
{
    /** All lists (public + own + subscribed) */
    public function index()
    {
        $public = WordList::with('creator')->get();
        return response()->json($public);
    }

    /** Lists created by the authenticated user */
    public function own()
    {
        $lists = WordList::with('words')->where('created_by', Auth::id())->get();
        return response()->json($lists);
    }

    /** Lists the user has subscribed to */
    public function subscribed()
    {
        $ids = DB::table('user_word_lists')
            ->where('user_id', Auth::id())
            ->pluck('word_list_id');
        $lists = WordList::with('words')->whereIn('id', $ids)->get();
        return response()->json($lists);
    }

    /** Single list with words + SRS metadata for current user */
    public function show($id)
    {
        $liste = WordList::with('words')->findOrFail($id);
        $srsData = [];
        foreach ($liste->words as $word) {
            $pivot = $word->getUserWordPivot();
            $srsData[$word->id] = [
                'interval'         => $pivot->interval ?? 0,
                'repetition_count' => $pivot->repetition_count ?? 0,
                'ease_factor'      => $pivot->ease_factor ?? 2.5,
                'next_review_at'   => $pivot->next_review_at ? Carbon::parse($pivot->next_review_at)->toDateTimeString() : null,
                'priority'         => $pivot ? (int)$pivot->priority : 3,
                'count'            => $pivot->count ?? 0,
            ];
        }
        return response()->json([
            'list'    => $liste,
            'srsData' => $srsData,
        ]);
    }

    /** Create a new list */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|min:3|max:40',
            'description' => 'nullable|string|max:200',
            'words'       => 'nullable|array',
            'words.*.base_word'   => 'required_with:words|string|max:50',
            'words.*.target_word' => 'required_with:words|string|max:50',
        ]);

        $liste = WordList::create([
            'name'        => $request->name,
            'description' => $request->description,
            'created_by'  => Auth::id(),
        ]);

        foreach ($request->words ?? [] as $pair) {
            $word = Word::create([
                'base_word'          => $pair['base_word'],
                'target_word'        => $pair['target_word'],
                'base_language_id'   => 1,
                'target_language_id' => 2,
                'word_list_id'       => $liste->id,
            ]);
            DB::table('user_words')->insert([
                'user_id'          => Auth::id(),
                'word_id'          => $word->id,
                'count'            => 0,
                'interval'         => 0,
                'ease_factor'      => 2.5,
                'repetition_count' => 0,
                'priority'         => 3,
                'next_review_at'   => now(),
            ]);
        }

        return response()->json($liste->load('words'), 201);
    }

    /** Update a list (name, description, words) */
    public function update(Request $request, $id)
    {
        $liste = WordList::findOrFail($id);
        if ($liste->created_by !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $liste->update($request->only('name', 'description'));
        return response()->json($liste);
    }

    /** Delete a list and all related data */
    public function destroy($id)
    {
        $liste = WordList::findOrFail($id);
        if ($liste->created_by !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        foreach ($liste->words as $word) {
            DB::table('user_words')->where('word_id', $word->id)->delete();
            DB::table('word_list_words')->where('word_id', $word->id)->delete();
            $word->delete();
        }
        $liste->delete();
        return response()->json(['message' => 'Deleted']);
    }

    /** Copy a list to own library */
    public function copy($id)
    {
        $liste = WordList::with('words')->findOrFail($id);
        $newList = $liste->replicate();
        $newList->created_by = Auth::id();
        $newList->save();
        foreach ($liste->words as $word) {
            $newWord = $word->replicate();
            $newWord->word_list_id = $newList->id;
            $newWord->save();
            DB::table('user_words')->insert([
                'user_id' => Auth::id(),
                'word_id' => $newWord->id,
                'count' => 0, 'interval' => 0, 'ease_factor' => 2.5,
                'repetition_count' => 0, 'priority' => 3,
                'next_review_at' => now(),
            ]);
        }
        return response()->json($newList->load('words'), 201);
    }

    /** Subscribe to a public list (shareable SRS) */
    public function subscribe($id)
    {
        $liste = WordList::with('words')->findOrFail($id);
        $exists = DB::table('user_word_lists')
            ->where('user_id', Auth::id())
            ->where('word_list_id', $id)
            ->exists();
        if ($exists) {
            return response()->json(['error' => 'Already subscribed'], 409);
        }
        DB::table('user_word_lists')->insert([
            'user_id' => Auth::id(),
            'word_list_id' => $id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        foreach ($liste->words as $word) {
            if (!DB::table('user_words')->where('user_id', Auth::id())->where('word_id', $word->id)->exists()) {
                DB::table('user_words')->insert([
                    'user_id' => Auth::id(),
                    'word_id' => $word->id,
                    'count' => 0, 'interval' => 0,
                    'ease_factor' => 2.5, 'repetition_count' => 0,
                    'priority' => 3, 'next_review_at' => now(),
                ]);
            }
        }
        return response()->json(['message' => 'Subscribed']);
    }

    /** Add a single word to a list */
    public function addWord(Request $request, $id)
    {
        $liste = WordList::findOrFail($id);
        $request->validate([
            'base_word'   => 'required|string|max:50',
            'target_word' => 'required|string|max:50',
        ]);
        $word = Word::create([
            'base_word'          => $request->base_word,
            'target_word'        => $request->target_word,
            'base_language_id'   => 1,
            'target_language_id' => 2,
            'word_list_id'       => $liste->id,
        ]);
        DB::table('user_words')->insert([
            'user_id' => Auth::id(),
            'word_id' => $word->id,
            'count' => 0, 'interval' => 0,
            'ease_factor' => 2.5, 'repetition_count' => 0,
            'priority' => 3, 'next_review_at' => now(),
        ]);
        return response()->json($word, 201);
    }

    /** Delete a single word (with FK cleanup) */
    public function deleteWord($id)
    {
        $word = Word::findOrFail($id);
        DB::table('user_words')->where('word_id', $word->id)->delete();
        DB::table('word_list_words')->where('word_id', $word->id)->delete();
        $word->delete();
        return response()->json(['message' => 'Word deleted']);
    }

    /** Update priority for a word */
    public function updatePriority(Request $request, $id)
    {
        $request->validate(['priority' => 'required|integer|between:1,5']);
        $updated = DB::table('user_words')
            ->where('user_id', Auth::id())
            ->where('word_id', $id)
            ->update(['priority' => $request->priority]);
        if (!$updated) {
            return response()->json(['error' => 'Word not found for user'], 404);
        }
        return response()->json(['priority' => $request->priority]);
    }
}
