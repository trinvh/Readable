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
        Commands\QueuesListener::class,
        Commands\DailyScanStoriesFromSourcesCommand::class,
        Commands\DailyUpdateStoryCommand::class,
        Commands\DailyUpdateChaptersCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('start-queue-listener')->everyMinute();
        
        $schedule->command('scan-new-stories-from-sources')->dailyAt('02:00');
        //$schedule->command('update-story')->daily();
        $schedule->command('update-chapters')->hourly();
    }
}
