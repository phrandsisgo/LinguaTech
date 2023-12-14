<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LangOption;

class LanguageOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LangOption::where('id', 1)->updateOrCreate([
            'language_name' => 'Deutsch',
            'language_code' => 'DE',
            // 'lang_difficulty' bleibt unverändert (null)
        ]);

        LangOption::where('id', 2)->updateOrCreate([
            'language_name' => 'Deutsch A1',
            'language_code' => 'DE',
            'lang_difficulty' => 'A1',
        ]);

        LangOption::where('id', 3)->updateOrCreate([
            'language_name' => 'Deutsch A2',
            'language_code' => 'DE',
            'lang_difficulty' => 'A2',
        ]);

        LangOption::where('id', 4)->updateOrCreate([
            'language_name' => 'Deutsch B1',
            'language_code' => 'DE',
            'lang_difficulty' => 'B1',
        ]);

        LangOption::where('id', 5)->updateOrCreate([
            'language_name' => 'Deutsch B2',
            'language_code' => 'DE',
            'lang_difficulty' => 'B2',
        ]);

        LangOption::where('id', 6)->updateOrCreate([
            'language_name' => 'Deutsch C1',
            'language_code' => 'DE',
            'lang_difficulty' => 'C1',
        ]);

        LangOption::where('id', 7)->updateOrCreate([
            'language_name' => 'Deutsch C2',
            'language_code' => 'DE',
            'lang_difficulty' => 'C2',
        ]);

        LangOption::where('id', 8)->updateOrCreate([
            'language_name' => 'English',
            'language_code' => 'EN',
            // 'lang_difficulty' bleibt unverändert (null)
        ]);

        LangOption::where('id', 9)->updateOrCreate([
            'language_name' => 'English A1',
            'language_code' => 'EN',
            'lang_difficulty' => 'A1',
        ]);

        LangOption::where('id', 10)->updateOrCreate([
            'language_name' => 'English A2',
            'language_code' => 'EN',
            'lang_difficulty' => 'A2',
        ]);

        LangOption::where('id', 11)->updateOrCreate([
            'language_name' => 'English B1',
            'language_code' => 'EN',
            'lang_difficulty' => 'B1',
        ]);

        LangOption::where('id', 12)->updateOrCreate([
            'language_name' => 'English B2',
            'language_code' => 'EN',
            'lang_difficulty' => 'B2',
        ]);

        LangOption::where('id', 13)->updateOrCreate([
            'language_name' => 'English C1',
            'language_code' => 'EN',
            'lang_difficulty' => 'C1',
        ]);

        LangOption::where('id', 14)->updateOrCreate([
            'language_name' => 'English C2',
            'language_code' => 'EN',
            'lang_difficulty' => 'C2',
        ]);

        LangOption::where('id', 15)->updateOrCreate([
            'language_name' => 'Français',
            'language_code' => 'FR',
            // 'lang_difficulty' bleibt unverändert (null)
        ]);

        LangOption::where('id', 16)->updateOrCreate([
            'language_name' => 'Français A1',
            'language_code' => 'FR',
            'lang_difficulty' => 'A1',
        ]);

        LangOption::where('id', 17)->updateOrCreate([
            'language_name' => 'Français A2',
            'language_code' => 'FR',
            'lang_difficulty' => 'A2',
        ]);

        LangOption::where('id', 18)->updateOrCreate([
            'language_name' => 'Français B1',
            'language_code' => 'FR',
            'lang_difficulty' => 'B1',
        ]);

        LangOption::where('id', 19)->updateOrCreate([
            'language_name' => 'Français B2',
            'language_code' => 'FR',
            'lang_difficulty' => 'B2',
        ]);

        LangOption::where('id', 20)->updateOrCreate([
            'language_name' => 'Français C1',
            'language_code' => 'FR',
            'lang_difficulty' => 'C1',
        ]);

        LangOption::where('id', 21)->updateOrCreate([
            'language_name' => 'Français C2',
            'language_code' => 'FR',
            'lang_difficulty' => 'C2',
        ]);

        LangOption::where('id', 22)->updateOrCreate([
            'language_name' => 'Русский',
            'language_code' => 'RU',
            // 'lang_difficulty' bleibt unverändert (null)
        ]);

        LangOption::where('id', 23)->updateOrCreate([
            'language_name' => 'Русский A1',
            'language_code' => 'RU',
            'lang_difficulty' => 'A1',
        ]);

        LangOption::where('id', 24)->updateOrCreate([
            'language_name' => 'Русский A2',
            'language_code' => 'RU',
            'lang_difficulty' => 'A2',
        ]);

        LangOption::where('id', 25)->updateOrCreate([
            'language_name' => 'Русский B1',
            'language_code' => 'RU',
            'lang_difficulty' => 'B1',
        ]);

        LangOption::where('id', 26)->updateOrCreate([
            'language_name' => 'Русский B2',
            'language_code' => 'RU',
            'lang_difficulty' => 'B2',
        ]);

        LangOption::where('id', 27)->updateOrCreate([
            'language_name' => 'Русский C1',
            'language_code' => 'RU',
            'lang_difficulty' => 'C1',
        ]);

        LangOption::where('id', 28)->updateOrCreate([
            'language_name' => 'Русский C2',
            'language_code' => 'RU',
            'lang_difficulty' => 'C2',
        ]);

        LangOption::where('id', 29)->updateOrCreate([
            'language_name' => 'Português',
            'language_code' => 'PT',
            // 'lang_difficulty' bleibt unverändert (null)
        ]);

        LangOption::where('id', 30)->updateOrCreate([
            'language_name' => 'Português A1',
            'language_code' => 'PT',
            'lang_difficulty' => 'A1',
        ]);

        LangOption::where('id', 31)->updateOrCreate([
            'language_name' => 'Português A2',
            'language_code' => 'PT',
            'lang_difficulty' => 'A2',
        ]);

        LangOption::where('id', 32)->updateOrCreate([
            'language_name' => 'Português B1',
            'language_code' => 'PT',
            'lang_difficulty' => 'B1',
        ]);

        LangOption::where('id', 33)->updateOrCreate([
            'language_name' => 'Português B2',
            'language_code' => 'PT',
            'lang_difficulty' => 'B2',
        ]);

        LangOption::where('id', 34)->updateOrCreate([
            'language_name' => 'Português C1',
            'language_code' => 'PT',
            'lang_difficulty' => 'C1',
        ]);

        LangOption::where('id', 35)->updateOrCreate([
            'language_name' => 'Português C2',
            'language_code' => 'PT',
            'lang_difficulty' => 'C2',
        ]);

    }
}
