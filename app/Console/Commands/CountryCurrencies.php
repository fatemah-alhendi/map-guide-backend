<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;

class CountryCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'map-guide:country-currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add the currencies of the country into the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currencyFile = storage_path('app/public/currency.csv');

        if (!file_exists($currencyFile) || !is_readable($currencyFile)) {
            Log::info("File not found!!");
        } else {
            if (($handle = fopen($currencyFile, 'r')) !== false) {
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    \DB::table('countries_data')->insert($ow);
                }
                fclose($handle);
            }
        }
    }
}
