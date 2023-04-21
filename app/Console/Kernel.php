<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\EmailAlerts;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\CheckNews::class,
        \App\Console\Commands\RemoveOldNews::class,
        \App\Console\Commands\EmailAlertHourly::class,
        \App\Console\Commands\EmailAlertDaily::class,
        // Process news file
        \App\Console\Commands\NewsQueue::class,
        \App\Console\Commands\NewsWork::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('CheckNews:getnews')->withoutOverlapping()->everyMinute();
        $schedule->command('EmailAlertHourly:checknews')->withoutOverlapping()->hourly();
        foreach(EmailAlerts::DAILY_TIME_OPTIONS as $time) {
            $schedule->command('EmailAlertDaily:checknews', [$time])->withoutOverlapping()->dailyAt($time)->timezone("America/New_York")->weekdays();
        }
        $schedule->command('RemoveOldNews:olderthenyear')->dailyAt("12:00")->timezone("America/New_York");
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
