<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     * This is about deleting the pivot table word_list_wods and migrating the word_list_id column to the words table.
     */
    public function up(): void
    {
        /*
        SELECT word_list_id, COUNT(DISTINCT word_list_id) AS word_list_count
        FROM word_list_words
        GROUP BY word_list_id
        HAVING word_list_count > 1;

        //possible that this has to be freshly migrated after recieving the error message
        */

        // Überprüfe, ob es Wörter gibt, die zu mehreren Listen gehören
        echo "Migrating to delete pivotTable´word_list_wods´ and revision ´words´ column...\n";
        $wordsInMultipleLists = DB::table('word_list_words')
            ->select('word_id', DB::raw('COUNT(DISTINCT word_list_id) AS list_count'))
            ->groupBy('word_id')
            ->havingRaw('COUNT(DISTINCT word_list_id) > 1')
            ->get();

        if ($wordsInMultipleLists->isNotEmpty()) {
            // Wenn es Wörter gibt, die zu mehreren Listen gehören, gib eine Warnung aus.
            foreach ($wordsInMultipleLists as $word) {
                echo "Word ID {$word->word_id} belongs to multiple lists ({$word->list_count} lists). Migration not performed. Please run 'php artisan migrate:rollback' and correct the data.\n";
            }
            throw new Exception("Migration not worked");
        } else {
            // Wenn keine Überschneidungen vorhanden sind, füge die word_list_id Spalte zur words Tabelle hinzu
            Schema::table('words', function (Blueprint $table) {
                $table->unsignedBigInteger('word_list_id')->nullable()->after('id');
                $table->foreign('word_list_id')->references('id')->on('word_lists')->onDelete('set null');
            });

            // Migrate die Beziehungen von word_list_words zu words
            DB::table('word_list_words')->get()->each(function ($wordListWord) {
                DB::table('words')
                    ->where('id', $wordListWord->word_id)
                    ->update(['word_list_id' => $wordListWord->word_list_id]);
            });

            // Lösche die Pivot-Tabelle
            Schema::dropIfExists('word_list_words');
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
