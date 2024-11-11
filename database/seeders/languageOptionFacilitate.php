<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LangOption;
use App\Models\WordList;
use Illuminate\Support\Facades\DB;

class languageOptionFacilitate extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Simplified language options
        $languages = [
            ['id' => 1, 'language_name' => 'Neutral', 'language_code' => ' '],
            ['id' => 2, 'language_name' => 'English', 'language_code' => 'EN'],
            ['id' => 3, 'language_name' => 'Deutsch', 'language_code' => 'DE'],
            ['id' => 4, 'language_name' => 'Português', 'language_code' => 'PT'],
            ['id' => 5, 'language_name' => 'Français', 'language_code' => 'FR'],
            ['id' => 6, 'language_name' => 'Español', 'language_code' => 'ES'],
            ['id' => 7, 'language_name' => 'Русский', 'language_code' => 'RU'],
            ['id' => 8, 'language_name' => 'Nederlands', 'language_code' => 'NL'],
        ];

        // Update or create simplified language options
        foreach ($languages as $language) {
            LangOption::updateOrCreate(['id' => $language['id']], $language);
        }

        // Update WordList entries to reflect simplified language options
        $wordLists = WordList::all();
        foreach ($wordLists as $wordList) {
            $baseLangOptionId = $this->getSimplifiedLangOptionId($wordList->base_language);
            $targetLangOptionId = $this->getSimplifiedLangOptionId($wordList->target_language);
            $wordList->update([
                'base_language' => $baseLangOptionId,
                'target_language' => $targetLangOptionId
            ]);
        }

        // Update texts entries to reflect simplified language options
        $texts = DB::table('texts')->get();
        foreach ($texts as $text) {
            $langOptionId = $this->getSimplifiedLangOptionId($text->lang_option_id);
            DB::table('texts')->where('id', $text->id)->update(['lang_option_id' => $langOptionId]);
        }

        //then delete all the remaining langoptions
        LangOption::where('id', '>', 8)->delete();


    }

    /**
     * Get simplified language option ID based on the original ID.
     */
    private function getSimplifiedLangOptionId($originalId)
    {
        $mapping = [
            1 => 3, 2 => 3, 3 => 3, 4 => 3, 5 => 3, 6 => 3, 7 => 3, // Deutsch
            8 => 2, 9 => 2, 10 => 2, 11 => 2, 12 => 2, 13 => 2, 14 => 2, // English
            15 => 5, 16 => 5, 17 => 5, 18 => 5, 19 => 5, 20 => 5, 21 => 5, // Français
            22 => 7, 23 => 7, 24 => 7, 25 => 7, 26 => 7, 27 => 7, 28 => 7, // Русский
            29 => 4, 30 => 4, 31 => 4, 32 => 4, 33 => 4, 34 => 4, 35 => 4, // Português
            36 => 6, 37 => 6, 38 => 6, 39 => 6, 40 => 6, 41 => 6, // Español
            42 => 8, 43 => 8, 44 => 8, 45 => 8, 46 => 8, 47 => 8, 48 => 8, // Nederlands
            49 => 1, // Neutral
        ];

        return $mapping[$originalId] ?? 1; // Default to Neutral if not found
    }
}
