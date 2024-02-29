<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $emtriesCreatedByUser = DB::table('user_word_list')
        ->foreign('created_by')
        ->references('id')
        ->on('users');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
