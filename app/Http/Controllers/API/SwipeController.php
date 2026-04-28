<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WordList;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SwipeController extends Controller
{
    /**
     * Return only the due words for a learning session.
     */
    public function dueWords($id)
    {
        $liste = WordList::with('words')->findOrFail($id);

        foreach ($liste->words as $word) {
            $word->ensureUserWordEntryForAuthUser();
        }

        $dueWords = $liste->words->filter(function ($word) {
            $pivot = $word->getUserWordPivot();
            if (!$pivot) return false;
            if ($pivot->next_review_at === null) return true;
            return Carbon::parse($pivot->next_review_at)->lte(now());
        })->values();

        $languages = [
            'base_language'  => \App\Models\LangOption::find($liste->words[0]->base_language_id ?? 1),
            'target_language' => \App\Models\LangOption::find($liste->words[0]->target_language_id ?? 2),
        ];

        $srsData = [];
        foreach ($dueWords as $word) {
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
            'words'     => $dueWords,
            'languages' => $languages,
            'srsData'   => $srsData,
        ]);
    }

    /**
     * Handle a swipe (SM-2 algorithm).
     */
    public function handle(Request $request)
    {
        $request->validate([
            'wordId'    => 'required|integer',
            'direction' => 'required|in:left,right',
        ]);

        $word = Word::findOrFail($request->wordId);
        $userId = Auth::id();

        $userWord = DB::table('user_words')
            ->where('user_id', $userId)
            ->where('word_id', $word->id)
            ->first();

        if (!$userWord) {
            DB::table('user_words')->insert([
                'user_id' => $userId, 'word_id' => $word->id,
                'count' => 0, 'interval' => 0, 'ease_factor' => 2.5,
                'repetition_count' => 0, 'priority' => 3, 'next_review_at' => now(),
            ]);
            $userWord = DB::table('user_words')->where('user_id', $userId)->where('word_id', $word->id)->first();
        }

        $interval      = $userWord->interval;
        $easeFactor    = $userWord->ease_factor;
        $repetitionCount = $userWord->repetition_count;
        $count         = $userWord->count;
        $priority      = $userWord->priority ?? 3;

        $priorityFactors = [1 => 2.0, 2 => 1.5, 3 => 1.0, 4 => 0.8, 5 => 0.6];
        $priorityFactor = $priorityFactors[$priority] ?? 1.0;

        if ($request->direction == 'left') {
            $quality = 0;
            $repetitionCount = 0;
            $interval = max(1, round(1 * $priorityFactor));
            $easeFactor = $easeFactor + (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02));
            if ($easeFactor < 1.3) $easeFactor = 1.3;
            $count = max(0, $count - 1);
            $nextReviewAt = now()->addDays($interval);
        } else {
            $quality = 5;
            if ($repetitionCount == 0) {
                $interval = max(1, round(1 * $priorityFactor));
            } elseif ($repetitionCount == 1) {
                $interval = max(1, round(6 * $priorityFactor));
            } else {
                $interval = max(1, round($interval * $easeFactor * $priorityFactor));
            }
            $repetitionCount++;
            $easeFactor = $easeFactor + (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02));
            if ($easeFactor < 1.3) $easeFactor = 1.3;
            $count = $count + 1;
            $nextReviewAt = now()->addDays($interval);
        }

        DB::table('user_words')
            ->where('user_id', $userId)
            ->where('word_id', $word->id)
            ->update([
                'count'            => $count,
                'interval'         => $interval,
                'ease_factor'      => round($easeFactor, 2),
                'repetition_count' => $repetitionCount,
                'next_review_at'   => $nextReviewAt,
            ]);

        return response()->json([
            'success'          => true,
            'wordId'           => $word->id,
            'count'            => $count,
            'interval'         => $interval,
            'ease_factor'      => round($easeFactor, 2),
            'repetition_count' => $repetitionCount,
            'next_review_at'   => $nextReviewAt->toDateTimeString(),
        ]);
    }

    /**
     * Undo the last swipe by restoring old SRS values.
     */
    public function undo(Request $request)
    {
        $request->validate([
            'wordId'              => 'required|integer',
            'old_interval'        => 'required|integer',
            'old_ease_factor'     => 'required|numeric',
            'old_repetition_count' => 'required|integer',
            'old_count'           => 'required|integer',
            'old_next_review_at'  => 'nullable|string',
        ]);

        DB::table('user_words')
            ->where('user_id', Auth::id())
            ->where('word_id', $request->wordId)
            ->update([
                'interval'         => $request->old_interval,
                'ease_factor'      => $request->old_ease_factor,
                'repetition_count' => $request->old_repetition_count,
                'count'            => $request->old_count,
                'next_review_at'   => $request->old_next_review_at ? Carbon::parse($request->old_next_review_at) : now(),
            ]);

        return response()->json(['success' => true, 'wordId' => $request->wordId]);
    }
}
