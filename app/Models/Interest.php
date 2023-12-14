<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
//wird verwendet vom User Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
}