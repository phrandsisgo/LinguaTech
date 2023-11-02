<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Relations\BelongsToMany;


class Words extends Model
{
    use HasFactory;

    public function wordListWord(): BelongsToMany{
        return $this->belongsToMany(WordListWord::class);
    }
    public function langOption(): BelongsToMany{
        return $this->belongsToMany(LangOption::class);
    }
    public function userWords(): BelongsToMany{
        return $this->belongsToMany(UserWords::class);
    }
}
