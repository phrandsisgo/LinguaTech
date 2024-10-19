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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->timestamp('last_logged_in')->nullable(); // Letzte Anmeldung
            $table->timestamp('subscribed_until')->nullable(); // Bis wann ist das Abo gültig
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('credits');
            $table->dropColumn('last_logged_in');
            $table->dropColumn('subscribed_until');
        });
    }
};
