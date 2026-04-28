<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_words', function (Blueprint $table) {
            $table->integer('priority')->default(3)->after('repetition_count');
        });
    }

    public function down(): void
    {
        Schema::table('user_words', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
};
