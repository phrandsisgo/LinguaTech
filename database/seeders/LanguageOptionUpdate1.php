<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LangOption;

class LanguageOptionUpdate1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creating langoptions for spanish speakers
        LangOption::where('id', 35)->updateOrCreate([
            'language_name' => 'Español',
            'language_code' => 'ES',
            // 'lang_difficulty' bleibt unverändert (null)
        ]);
        LangOption::where('id', 36)->updateOrCreate([
            'language_name' => 'Español A1',
            'language_code' => 'ES',
            'lang_difficulty' => 'A1',
        ]);
        LangOption::where('id', 37)->updateOrCreate([
            'language_name' => 'Español A2',
            'language_code' => 'ES',
            'lang_difficulty' => 'A2',
        ]);
        LangOption::where('id', 38)->updateOrCreate([
            'language_name' => 'Español B1',
            'language_code' => 'ES',
            'lang_difficulty' => 'B1',
        ]);
        LangOption::where('id', 39)->updateOrCreate([
            'language_name' => 'Español B2',
            'language_code' => 'ES',
            'lang_difficulty' => 'B2',
        ]);
        LangOption::where('id', 40)->updateOrCreate([
            'language_name' => 'Español C1',
            'language_code' => 'ES',
            'lang_difficulty' => 'C1',
        ]);
        LangOption::where('id', 41)->updateOrCreate([
            'language_name' => 'Español C2',
            'language_code' => 'ES',
            'lang_difficulty' => 'C2',
        ]);

        //now creating langoptions for dutch speakers
        LangOption::where('id', 42)->updateOrCreate([
            'language_name' => 'Nederlands',
            'language_code' => 'NL',
            // 'lang_difficulty' bleibt unverändert (null)
        ]);
        LangOption::where('id', 43)->updateOrCreate([
            'language_name' => 'Nederlands A1',
            'language_code' => 'NL',
            'lang_difficulty' => 'A1',
        ]);
        LangOption::where('id', 44)->updateOrCreate([
            'language_name' => 'Nederlands A2',
            'language_code' => 'NL',
            'lang_difficulty' => 'A2',
        ]);
        LangOption::where('id', 45)->updateOrCreate([
            'language_name' => 'Nederlands B1',
            'language_code' => 'NL',
            'lang_difficulty' => 'B1',
        ]);
        LangOption::where('id', 46)->updateOrCreate([
            'language_name' => 'Nederlands B2',
            'language_code' => 'NL',
            'lang_difficulty' => 'B2',
        ]);
        LangOption::where('id', 47)->updateOrCreate([
            'language_name' => 'Nederlands C1',
            'language_code' => 'NL',
            'lang_difficulty' => 'C1',
        ]);
        LangOption::where('id', 48)->updateOrCreate([
            'language_name' => 'Nederlands C2',
            'language_code' => 'NL',
            'lang_difficulty' => 'C2',
        ]);

        //creating a neutral language option
        LangOption::where('id', 49)->updateOrCreate([
            'language_name' => 'Neutral',
            'language_code' => ' ',
            // 'lang_difficulty' bleibt unverändert (null)
        ]);
    }   
}
