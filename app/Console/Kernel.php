<?php

namespace App\Console;

use App\Http\Controllers\SuscriptionController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('handle:cancelled-subscription-states')
        ->daily()
        ->at('14:00')
        ->timezone('Europe/Madrid')
        ->withoutOverlapping();

        $schedule->command('handle:automatic-renovation-suscription')
        ->daily()
        ->at('21:05')
        ->timezone('Europe/Madrid')
        ->withoutOverlapping();
        
    }
    

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
