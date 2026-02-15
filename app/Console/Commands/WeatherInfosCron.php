<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WeatherInfosCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This process will store weather data every 10 minutes.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
