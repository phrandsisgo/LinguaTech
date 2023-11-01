<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_word_lists', function (Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('word_list_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //vielleicht braucht es noch dropifexists hier.
    }
};
