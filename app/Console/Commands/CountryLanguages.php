<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CountryLanguages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'map-guide:country-language';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add the languages of the country into the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $languageFile = storage_path('app/public/languages.csv');

        if (!file_exists($languageFile) || !is_readable($languageFile)) {
            Log::info("File not found!!");
        } else {
            if (($handle = fopen($languageFile, 'r')) !== false) {
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    $dbRecord = \DB::table('countries_data')->where('country', $row[0]);
                    if($dbRecord) {
                        \DB::table('countries_data')->update('languages', $row[1]);
                    }
                }
                fclose($handle);
            }
        }
    }
}
