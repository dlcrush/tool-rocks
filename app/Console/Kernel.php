<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\IngestYTData::class,
        Commands\FillTVQueue::class,
        Commands\IngestWPData::class,
        Commands\IngestTourData::class,
        Commands\GenerateDailyFix::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->command('ingest:yt')->timezone('America/New_York')->everyTenMinutes();
        $schedule->command('ingest:wp')->timezone('America/New_York')->everyTenMinutes();
        $schedule->command('dailyfix:generate')->timezone('America/New_York')->dailyAt('02:00');

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
