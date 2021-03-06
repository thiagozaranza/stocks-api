<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Console\Commands\ImportSetorialCommand;
use App\Console\Commands\ImportIndicesCommand;
use App\Console\Commands\ImportEmpresasIndicesCommand;
use App\Console\Commands\CacheCleanCommand;
use App\Console\Commands\ImportTesouroCommand;
use App\Console\Commands\ImportDadosCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ImportSetorialCommand::class,
        ImportIndicesCommand::class,
        ImportEmpresasIndicesCommand::class,
        CacheCleanCommand::class,
        ImportTesouroCommand::class,
        ImportDadosCommand::class
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
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
