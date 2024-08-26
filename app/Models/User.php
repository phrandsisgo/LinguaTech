<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Relations\HasMany;
//use Illuminate\Database\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function createdWordLists(){
        return $this->hasMany(WordList::class, 'created_by', 'id');
    }

    public function wordLists(){
        return $this->belongsToMany(WordList::class, 'user_word_lists', 'user_id', 'word_list_id');
    }

    public function words(){
        return $this->belongsToMany(Word::class, 'user_words', 'user_id', 'word_id');
    }
    public function interests(): BelongsToMany{
        return $this->belongsToMany(Interest::class, 'interest_user', 'user_id', 'interest_id');
    }
    public function languages(): BelongsToMany{
        return $this->belongsToMany(LangOption::class, 'lang_option_users', 'user_id', 'lang_option_id');
    }
}
