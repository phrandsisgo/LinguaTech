<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Word;



return new class extends Migration
{
    /**
     * Run the migrations.
     * This is about deleting the pivot table word_list_wods and migrating the word_list_id column to the words table.
     */
    public function up(): void
    {

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
                //create new words Object in table and a new word_list_words table that take $word-> credentials to make an exact copy but with a newer ID
                //finding the corresponding pivot table "word_list_words" and store every list id in an array
                $list_id = DB::table('word_list_words')->where('word_id', $word->word_id)->pluck('word_list_id');
                //create a new word object with the same credentials but with a new id
                Word::create([
                    'target_language_id' => $word->target_language_id,
                    'base_language_id' => $word->base_language_id,
                    'base_word' => $word->base_word,
                    'target_word' => $word->target_word,
                    'created_at' => $word->created_at,
                    'updated_at' => $word->updated_at,
                    'created_by' => $word->created_by,
                    'count' => 0,
                ]);
                //store the new word object in a variable
                $word = Word::where('target_language_id', $word->target_language_id)
                    ->where('base_language_id', $word->base_language_id)
                    ->where('base_word', $word->base_word)
                    ->where('target_word', $word->target_word)
                    ->where('created_at', $word->created_at)
                    ->where('updated_at', $word->updated_at)
                    ->where('created_by', $word->created_by)
                    ->first();
                //create a new pivot table with the new word id and the list id
                foreach ($list_id as $id) {
                    DB::table('word_list_words')->insert([
                        'word_id' => $word->id,
                        'word_list_id' => $id,
                    ]);
                }
                //delete the old word object and the old pivot table
                DB::table('word_list_words')->where('word_id', $word->id)->delete();
                Word::where('id', $word->id)->delete();
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
