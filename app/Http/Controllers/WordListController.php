<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordList;
use App\Models\WordListWord;
use App\Models\LangOption;
use App\Models\User;
use App\Models\Word;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WordListController extends Controller
{
    public function library()
    {
        $libraryList = WordList::get();
        return view('library', ['libraryList' => $libraryList]);
    }

    public function listShow($id)
    {
        $liste = WordList::with('words')->find($id);
        return view('list_show', ['liste' => $liste]);
    }

    public function listLoad($id)
    {
        $liste = WordList::with('words')->find($id);
        return view('list_update', ['liste' => $liste]);
    }

    public function copyListLoad($id)
    {
        $liste = WordList::with('words')->find($id);
        return view('copy-list', ['liste' => $liste]);
    }

    public function list_add_word(Request $request)
    {
        $request->validate([
            'baseWord' => 'required|min:1|max:50',
            'targetWord' => 'required|min:1|max:50',
        ]);
        $word = new Word;
        $word->base_word = $request->targetWord;
        $word->target_word = $request->baseWord;
        $word->base_language_id = 1;
        $word->target_language_id = 2;
        $word->word_list_id = $request->list;
        $word->save();

        DB::table('user_words')->insert([
            'user_id' => auth()->id(),
            'word_id' => $word->id,
            'count' => 0,
            'interval' => 0,
            'ease_factor' => 2.5,
            'repetition_count' => 0,
            'next_review_at' => now(),
        ]);

        $id = $request->list;
        return redirect('/list_show/' . $id);
    }

    public function list_update_function(Request $request, $id)
    {
        $request->validate([
            'listTitle' => 'required|min:3|max:20',
            'baseWord.*' => 'required|min:1|max:50',
            'targetWord.*' => 'required|min:1|max:50',
            'listDescription' => 'max:200',
        ]);

        $liste = WordList::find($id);
        $baseWords = $request->baseWord;
        $targetWords = $request->targetWord;
        $wordIds = $request->wordIds ?? [];
        $deletedWordIds = $request->deletedWordIds ?? [];

        foreach ($deletedWordIds as $wordId) {
            $word = Word::find($wordId);
            if ($word) {
                DB::table('user_words')->where('word_id', $word->id)->delete();
                DB::table('word_list_words')->where('word_id', $word->id)->delete();
                $word->delete();
            }
        }

        foreach ($wordIds as $index => $wordId) {
            if ($wordId === 'new') {
                $word = new Word;
                $word->base_word = $baseWords[$index];
                $word->target_word = $targetWords[$index];
                $word->base_language_id = 1;
                $word->target_language_id = 2;
                $word->word_list_id = $liste->id;
                $word->save();

                DB::table('user_words')->insert([
                    'user_id' => auth()->id(),
                    'word_id' => $word->id,
                    'count' => 0,
                    'interval' => 0,
                    'ease_factor' => 2.5,
                    'repetition_count' => 0,
                    'next_review_at' => now(),
                ]);
            } else {
                $word = Word::find($wordId);
                if ($word) {
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

    public function swipeLearn($id)
    {
        $liste = WordList::with('words')->find($id);

        foreach ($liste->words as $word) {
            $word->ensureUserWordEntryForAuthUser();
        }

        $languages = [
            'base_language' => LangOption::find($liste->words[0]->base_language_id),
            'target_language' => LangOption::find($liste->words[0]->target_language_id),
        ];

        $dueWords = $liste->words->filter(function ($word) {
            $pivot = $word->getUserWordPivot();
            if (!$pivot) {
                return false;
            }
            if ($pivot->next_review_at === null) {
                return true;
            }
            return Carbon::parse($pivot->next_review_at)->lte(now());
        });

        $liste->setRelation('words', $dueWords->values());

        return view('swipeLearn', ['liste' => $liste, 'languages' => $languages]);
    }

    public function list_create_function(Request $request)
    {
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

        $userId = auth()->user()->id;

        foreach ($request->baseWord as $index => $baseWord) {
            $word = new Word;
            $word->base_word = $baseWord;
            $word->target_word = $request->targetWord[$index];
            $word->base_language_id = 1;
            $word->target_language_id = 2;
            $word->word_list_id = $liste->id;
            $word->save();

            DB::table('user_words')->insert([
                'user_id' => $userId,
                'word_id' => $word->id,
                'count' => 0,
                'interval' => 0,
                'ease_factor' => 2.5,
                'repetition_count' => 0,
                'next_review_at' => now(),
            ]);
        }

        return redirect('/library');
    }

    public function list_delete_function($id)
    {
        $liste = WordList::find($id);

        if (!$liste) {
            return redirect('/library')->withErrors(['Die gesuchte Liste existiert nicht.']);
        }

        foreach ($liste->words as $word) {
            DB::table('user_words')->where('word_id', $word->id)->delete();
            DB::table('word_list_words')->where('word_id', $word->id)->delete();
            $word->delete();
        }

        $liste->delete();

        return redirect('/library');
    }

    public function word_delete_function($id, $listId)
    {
        $word = Word::find($id);
        if ($word) {
            DB::table('user_words')->where('word_id', $word->id)->delete();
            DB::table('word_list_words')->where('word_id', $word->id)->delete();
            $word->delete();
        }
        return redirect('/list_show/' . $listId);
    }

    public function word_list_copy($id)
    {
        dd($id);
        $liste = WordList::with('words')->find($id);
        return view('list_copy', ['liste' => $liste]);
    }

    public function copyList($id)
    {
        $liste = WordList::with('words')->find($id);
        if (!$liste) {
            return redirect('/library')->withErrors('Liste nicht gefunden.');
        }

        $newList = $liste->replicate();
        $newList->created_by = auth()->user()->id;
        $newList->created_at = now();
        $newList->updated_at = now();
        $newList->save();

        foreach ($liste->words as $word) {
            $newWord = $word->replicate();
            $newWord->word_list_id = $newList->id;
            $newWord->created_at = now();
            $newWord->updated_at = now();
            $newWord->save();

            DB::table('user_words')->insert([
                'user_id' => auth()->id(),
                'word_id' => $newWord->id,
                'count' => 0,
                'interval' => 0,
                'ease_factor' => 2.5,
                'repetition_count' => 0,
                'next_review_at' => now(),
            ]);
        }

        return redirect('/library');
    }

    public function swipeHandle(Request $request)
    {
        $request->validate([
            'wordId' => 'required',
            'direction' => 'required',
        ]);

        $word = Word::findOrFail($request->wordId);
        $userId = auth()->id();

        $userWord = DB::table('user_words')
            ->where('user_id', $userId)
            ->where('word_id', $word->id)
            ->first();

        if (!$userWord) {
            DB::table('user_words')->insert([
                'user_id' => $userId,
                'word_id' => $word->id,
                'count' => 0,
                'interval' => 0,
                'ease_factor' => 2.5,
                'repetition_count' => 0,
                'next_review_at' => now(),
            ]);

            $userWord = DB::table('user_words')
                ->where('user_id', $userId)
                ->where('word_id', $word->id)
                ->first();
        }

        $interval = $userWord->interval;
        $easeFactor = $userWord->ease_factor;
        $repetitionCount = $userWord->repetition_count;
        $count = $userWord->count;

        if ($request->direction == 'left') {
            $quality = 0;
            $repetitionCount = 0;
            $interval = 1;

            $easeFactor = $easeFactor + (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02));
            if ($easeFactor < 1.3) {
                $easeFactor = 1.3;
            }

            $count = max(0, $count - 1);
            $nextReviewAt = now()->addDays($interval);

            DB::table('user_words')
                ->where('user_id', $userId)
                ->where('word_id', $word->id)
                ->update([
                    'count' => $count,
                    'interval' => $interval,
                    'ease_factor' => round($easeFactor, 2),
                    'repetition_count' => $repetitionCount,
                    'next_review_at' => $nextReviewAt,
                ]);

            return response()->json([
                'success' => 'success',
                'count' => $count,
                'wordId' => $word->id,
            ], 200);
        } elseif ($request->direction == 'right') {
            $quality = 5;

            if ($repetitionCount == 0) {
                $interval = 1;
            } elseif ($repetitionCount == 1) {
                $interval = 6;
            } else {
                $interval = round($interval * $easeFactor);
            }

            $repetitionCount++;

            $easeFactor = $easeFactor + (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02));
            if ($easeFactor < 1.3) {
                $easeFactor = 1.3;
            }

            $count = $count + 1;
            $nextReviewAt = now()->addDays($interval);

            DB::table('user_words')
                ->where('user_id', $userId)
                ->where('word_id', $word->id)
                ->update([
                    'count' => $count,
                    'interval' => $interval,
                    'ease_factor' => round($easeFactor, 2),
                    'repetition_count' => $repetitionCount,
                    'next_review_at' => $nextReviewAt,
                ]);

            return response()->json([
                'success' => 'success',
                'count' => $count,
                'wordId' => $word->id,
            ], 200);
        }

        return response()->json(['error' => 'false input(direction expected)'], 400);
    }
}
