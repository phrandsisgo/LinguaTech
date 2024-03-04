<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*before this migration, the developer has to check if there are false entries by checking this command
        SELECT word_id, COUNT(DISTINCT user_id) AS user_count
        FROM user_words
        GROUP BY word_id
        HAVING user_count > 1;

        //possible that this has to be freshly migrated after recieving the error message
  
        */
        $wordsWithMultipleUsers = DB::table('user_words')
            ->select('word_id', DB::raw('COUNT(DISTINCT user_id) AS user_count'))
            ->groupBy('word_id')
            ->having('user_count', '>', 1)
            ->get();
        
        if($wordsWithMultipleUsers->isNotEmpty()){
            foreach($wordsWithMultipleUsers as $word){
                $wordId = $word->word_id;
                $userCount = $word->user_count;
                echo "migration not worked run ´php artisan migrate:rollback´ and migrate it again. \n word_id: $wordId, user_count: $userCount\n";
            }
        }else{
            //adding "created_by" column to "words" table
            echo "migration should worke\n";
            Schema::table('words', function (Blueprint $table) {
                $table->foreignId('created_by')->nullable()->constrained('users');
            });
            //migrate user_id from user_words to words
            $userWords = DB::table('user_words')->get();
            foreach($userWords as $userWord){
                $wordId = $userWord->word_id;
                $userId = $userWord->user_id;
                DB::table('words')
                    ->where('id', $wordId)
                    ->update(['created_by' => $userId]);
            }
            //drop the table user_words
            Schema::dropIfExists('user_words');
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
