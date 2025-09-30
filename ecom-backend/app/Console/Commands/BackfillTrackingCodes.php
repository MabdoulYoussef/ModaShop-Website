<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class BackfillTrackingCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:backfill-tracking-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate tracking codes for existing orders that don\'t have them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to backfill tracking codes for existing orders...');

        $ordersWithoutTracking = Order::whereNull('tracking_code')->get();

        if ($ordersWithoutTracking->isEmpty()) {
            $this->info('All orders already have tracking codes!');
            return;
        }

        $this->info("Found {$ordersWithoutTracking->count()} orders without tracking codes.");

        $bar = $this->output->createProgressBar($ordersWithoutTracking->count());
        $bar->start();

        foreach ($ordersWithoutTracking as $order) {
            $trackingCode = $this->generateTrackingCode();
            $order->update(['tracking_code' => $trackingCode]);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $this->info("Successfully generated tracking codes for {$ordersWithoutTracking->count()} orders!");
    }

    /**
     * Generate unique tracking code
     */
    private function generateTrackingCode(): string
    {
        do {
            $code = str_pad(random_int(10000000, 99999999), 8, '0', STR_PAD_LEFT);
        } while (Order::where('tracking_code', $code)->exists());

        return $code;
    }
}
