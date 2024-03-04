<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //drop the table user_word_list if it exists
        Schema::dropIfExists('user_word_list');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
