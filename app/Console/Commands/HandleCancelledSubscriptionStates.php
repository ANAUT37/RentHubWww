<?php

namespace App\Console\Commands;

use App\Http\Controllers\SuscriptionController;
use Illuminate\Console\Command;

class HandleCancelledSubscriptionStates extends Command
{
    protected $signature = 'handle:cancelled-subscription-states';

    protected $description = 'Handle cancelled subscription states';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subscriptionService = new SuscriptionController();
        $subscriptionService->handleCancelledSubscriptionStates();
    }
}
