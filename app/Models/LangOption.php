<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//is beeing used 2 times by the foreign key of "words" table
class LangOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'language_name',
        'language_difficulty',
        'language_code',
    ];
}
