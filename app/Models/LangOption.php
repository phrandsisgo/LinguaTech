<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Relations\HasMany;

//is beeing used 2 times by the foreign key of "words" table
class LangOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'language_name',
        'language_difficulty',
        'language_code',
    ];
    public function words(): HasMany{
        return $this->HasMany(Word::class);//wird mir noch mehr empfohlen durch copilot
    }
}
