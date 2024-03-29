<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordList extends Model
{
    use HasFactory;
    //maby this also needs to have a protected fillable array but I'm unsure (have to check with beni) --> yes do this

    protected $guarded = [];

    // creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'user_word_lists', 'word_list_id', 'user_id');
    }
    
    public function words()
    {
        return $this->hasMany(Word::class, 'word_list_id');
    }
    public function getWordListById($id){
        return $this->belongsToMany(Word::class)->wherePivot('word_list_id', $id);
    }
}
