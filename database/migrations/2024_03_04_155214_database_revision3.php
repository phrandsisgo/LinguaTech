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
    public function up()
    {
        echo "Migrating to update word_list_id in words table and remove pivot table word_list_words...\n";

        // Dupliziere Wörter, die in mehreren Listen vorkommen
        $wordsInMultipleLists = DB::table('word_list_words')
            ->select('word_id')
            ->groupBy('word_id')
            ->havingRaw('COUNT(DISTINCT word_list_id) > 1')
            ->pluck('word_id');

        foreach ($wordsInMultipleLists as $wordId) {
            // Dupliziere das Wort für jede Liste, in der es vorkommt
            $listsForWord = DB::table('word_list_words')->where('word_id', $wordId)->pluck('word_list_id');
            foreach ($listsForWord as $listId) {
                $wordData = DB::table('words')->where('id', $wordId)->first();
                // Erstelle ein neues Wort-Duplikat für jede Liste
                $newWordId = DB::table('words')->insertGetId([
                    // Übernimm alle notwendigen Daten aus dem bestehenden Wort
                    'content' => $wordData->content,
                    'word_list_id' => $listId,
                    // Füge weitere Spalten hinzu, wie benötigt
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            // Lösche das alte Wort, nachdem Duplikate erstellt wurden
            DB::table('words')->where('id', $wordId)->delete();
        }

        // Entferne Wörter, die in keiner Liste vorkommen
        $orphanWords = DB::table('words')
            ->whereNotIn('id', DB::table('word_list_words')->select('word_id'))
            ->delete();

        // Entferne die Pivot-Tabelle, da sie nicht mehr benötigt wird
        Schema::dropIfExists('word_list_words');

        echo "Migration completed successfully.\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
