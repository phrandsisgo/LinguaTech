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
        Schema::create('words', function (Blueprint $table){
            $table->id();
            $table->string('base_word');
            $table->string('target_word');
            $table->timestamps();
            $table->foreignId('base_language_id')->constrained('lang_options')->nullable();
            $table->foreignId('target_language_id')->constrained('lang_options')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
