<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;


class Word extends Model
{
    use HasFactory;

    // only needed if you want to have all listst a word belongs to(Beni)
     public function lists(): BelongsToMany{
         return $this->belongsToMany(WordList::class, 'word_list_words', 'word_id', 'word_list_id');
     }


    public function base(){
        return $this->hasOne(LangOption::class, 'id', 'base_language_id');
    }
    public function target(){
        return $this->hasOne(LangOption::class, 'id', 'target_language_id');}
    public function users(){
        return $this->belongsToMany(User::class,'user_words', 'word_id', 'user_id');
    }

    public function userWithPivot(){
        return $this->belongsToMany(User::class,'user_words', 'word_id', 'user_id')->withPivot('count');
    }

    public function count(){
        $userId = auth()->id();
        $wordId = $this->id;
    
        $count = DB::select("
            SELECT count 
            FROM user_words 
            WHERE user_id = $userId 
            AND word_id = $wordId
        ");
        //dd($count);
        return $count[0]->count;
        
    }

    public function increaseCountForAuthUser($amount){
        $this->users()->updateExistingPivot(auth()->id(), ['count' => $this->count() + $amount]);
    }
    
    public function decreaseCountForAuthUser($amount){
        $this->users()->updateExistingPivot(auth()->id(), ['count' => $this->count() - $amount]);
    }

}
