<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiUsageLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text_id',
        'prompt_tokens',
        'completion_tokens',
    ];

    protected $table = 'api_usage_logging'; // Specify the table name
}
