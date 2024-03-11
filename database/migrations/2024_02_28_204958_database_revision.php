<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
        // Drop the table
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->unsignedBigInteger('word_list_id')->nullable();
            $table->foreign('word_list_id')->references('id')->on('word_lists');
        });
        Schema::dropIfExists('user_word_list');
    }

    public function down(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->dropForeign(['word_list_id']);
            $table->dropColumn('word_list_id');
        });
    }
        

    /**
     * Reverse the migrations.
     */
};
