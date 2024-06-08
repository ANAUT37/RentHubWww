<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SuscriptionController;

class HandleAutomaticRenovationSuscriptionStates extends Command
{
    protected $signature = 'handle:automatic-renovation-suscription';

    protected $description = 'Handle automatic renovation suscription';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subscriptionService = new SuscriptionController();
        $subscriptionService->handleAutomaticRenovationSuscriptionStates();
    }
}
