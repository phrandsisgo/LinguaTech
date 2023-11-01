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
        Schema::create('word_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users');//not sure if "users" is needed
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();//not sure if this is needed
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
