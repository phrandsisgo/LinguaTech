<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordList extends Model
{
    use HasFactory;
    //maby this also needs to have a protected fillable array but I'm unsure (have to check with beni)

    public function userWordList()
    {
        return $this->belongsToMany(UserWordList::class);
    }
    public function wordListWord()
    {
        return $this->belongsToMany(WordListWord::class);
    }
}
