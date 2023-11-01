<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWordList extends Model
{
    //this is the connector beween user and word_list table so therefor not needing many belongs to and stuff
    use HasFactory;

}
