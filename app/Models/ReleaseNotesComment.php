<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class ReleaseNotesComment extends Model
{
    use HasFactory;

    // only needed if you want to have all listst a word belongs to(Beni)
     public function lists(): BelongsToMany{
         return $this->belongsToMany(WordList::class, 'word_list_words', 'word_id', 'word_list_id');
     }
}
