<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CountryCrimeRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'map-guide:country-crime-rate';

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
        $crimeRateFile = storage_path('app/public/crime-rate.csv');

        if (!file_exists($crimeRateFile) || !is_readable($crimeRateFile)) {
            Log::info("File not found!!");
        } else {
            if (($handle = fopen($crimeRateFile, 'r')) !== false) {
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    $dbRecord = \DB::table('countries_data')->where('country', $row[0]);
                    if($dbRecord) {
                        \DB::table('countries_data')->update('crime_data', $row);
                    }
                }
                fclose($handle);
            }
        }
    }
}
