<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory;
      public function langOption()
    {
        return $this->belongsTo(LangOption::class, 'lang_option_id');
    }
}
