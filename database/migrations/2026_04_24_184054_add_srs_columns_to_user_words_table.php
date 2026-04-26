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
        Schema::table("user_words", function (Blueprint $table) {
            $table->timestamp("next_review_at")->nullable();
            $table->integer("interval")->default(0);
            $table->float("ease_factor", 8, 2)->default(2.5);
            $table->integer("repetition_count")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("user_words", function (Blueprint $table) {
            $table->dropColumn(["next_review_at", "interval", "ease_factor", "repetition_count"]);
        });
    }
};