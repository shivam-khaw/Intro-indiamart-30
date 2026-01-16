<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Register the commands for the application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\PlatinumCronJob::class,
        \App\Console\Commands\TokenCron::class,
        \App\Console\Commands\SilverCron::class,
        \App\Console\Commands\GoldCron::class,
        \App\Console\Commands\Test1Command::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Run the platinum cron every 20 minutes
      $schedule->command('platinumcron:job2')->cron('*/20 * * * *');
        
        // Run the silver cron every 2 hours
        $schedule->command('silvercron:job2')->everyTwoHours();
        
        // Run the gold cron every 30 minutes
        $schedule->command('goldcron:job2')->everyThirtyMinutes();
        
        // Run the token cron every 45 minutes
        $schedule->command('token:access')->cron('*/45 * * * *'); // Custom cron expression for 45 minutes
        
        // Run the test1 command every minute
        $schedule->command('test1:run')->everyMinute();
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
