<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ReleaseNote extends Model
{
    use HasFactory;

    
    public function comments(){
        return $this->hasMany(ReleaseNotesComment::class);
    }

}
