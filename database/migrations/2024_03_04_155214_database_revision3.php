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
                $listsForWord = DB::table('word_list_words')->where('word_id', $wordId)->pluck('word_list_id');
                $wordData = DB::table('words')->where('id', $wordId)->first();
            
                // Für jede Liste, in der das Wort vorkommt, erstelle ein Duplikat des Worts
                foreach ($listsForWord as $listId) {
                    $newWordId = DB::table('words')->insertGetId([
                        'base_language_id' => $wordData->base_language_id,
                        'target_language_id' => $wordData->target_language_id,
                        'base_word' => $wordData->base_word,
                        'target_word' => $wordData->target_word,
                        'created_by' => $wordData->created_by,
                        'count' => $wordData->count,
                        'word_list_id' => $listId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            
                // Entferne alle Einträge in word_list_words für dieses Word, bevor das Wort gelöscht wird
                DB::table('word_list_words')->where('word_id', $wordId)->delete();
            
                // Lösche das ursprüngliche Wort, um Duplikate zu vermeiden
                DB::table('words')->where('id', $wordId)->delete();
            }
            
    
        // Lösche Wörter, die in keiner Liste vorkommen
        $orphanWordIds = DB::table('words')
            ->whereNull('word_list_id')
            ->pluck('id');
    
        DB::table('words')->whereIn('id', $orphanWordIds)->delete();
    
        // Entferne die Pivot-Tabelle
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
