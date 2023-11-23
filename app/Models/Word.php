<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


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

}
