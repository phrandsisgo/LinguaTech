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
        Schema::create('api_usage_logging', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID of the user making the request
            $table->unsignedBigInteger('text_id'); // ID of the generated text
            $table->integer('prompt_tokens'); // Number of prompt tokens used
            $table->integer('completion_tokens'); // Number of completion tokens used
            $table->timestamps(); // created_at and updated_at

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('text_id')->references('id')->on('texts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_usage_logging');
    }
};
