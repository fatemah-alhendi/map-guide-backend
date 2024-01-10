<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CountryNaturalDisaster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'map-guide:country-natural-disaster';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add the crime rate data of the country into the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $naturalDisasterFile = storage_path('app/public/natural-disasters.csv');

        if (!file_exists($naturalDisasterFile) || !is_readable($naturalDisasterFile)) {
            Log::info("File not found!!");
        } else {
            if (($handle = fopen($naturalDisasterFile, 'r')) !== false) {
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    $dbRecord = \DB::table('countries_data')->where('country', $row[0]);
                    if($dbRecord) {
                        \DB::table('countries_data')->update('natural_disasters', $row);
                    }
                }
                fclose($handle);
            }
        }
    }
}
