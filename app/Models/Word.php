<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Word extends Model
{
    use HasFactory;

    public function lists(): BelongsToMany
    {
        return $this->belongsToMany(WordList::class, 'word_list_words', 'word_id', 'word_list_id');
    }

    public function base()
    {
        return $this->hasOne(LangOption::class, 'id', 'base_language_id');
    }

    public function target()
    {
        return $this->hasOne(LangOption::class, 'id', 'target_language_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_words', 'word_id', 'user_id');
    }

    public function userWithPivot()
    {
        return $this->belongsToMany(User::class, 'user_words', 'word_id', 'user_id')
            ->withPivot('count', 'interval', 'ease_factor', 'repetition_count', 'next_review_at');
    }

    public function wordList()
    {
        return $this->belongsTo(WordList::class, 'word_list_id', 'id');
    }

    public function count()
    {
        $userId = auth()->id();
        $wordId = $this->id;

        $result = DB::table('user_words')
            ->where('user_id', $userId)
            ->where('word_id', $wordId)
            ->first();

        return $result ? $result->count : 0;
    }

    public function increaseCountForAuthUser($amount)
    {
        $newCount = $this->count() + $amount;
        $this->users()->updateExistingPivot(auth()->id(), ['count' => $newCount]);
    }

    public function decreaseCountForAuthUser($amount)
    {
        $newCount = max(0, $this->count() - $amount);
        $this->users()->updateExistingPivot(auth()->id(), ['count' => $newCount]);
    }

    public function getUserWordPivot()
    {
        return DB::table('user_words')
            ->where('user_id', auth()->id())
            ->where('word_id', $this->id)
            ->first();
    }

    public function ensureUserWordEntryForAuthUser()
    {
        $userId = auth()->id();
        if (!$userId) {
            return;
        }

        $exists = DB::table('user_words')
            ->where('user_id', $userId)
            ->where('word_id', $this->id)
            ->exists();

        if (!$exists) {
            DB::table('user_words')->insert([
                'user_id' => $userId,
                'word_id' => $this->id,
                'count' => 0,
                'interval' => 0,
                'ease_factor' => 2.5,
                'repetition_count' => 0,
                'next_review_at' => now(),
            ]);
        }
    }
}
