<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class RunCustomerSegmentation extends Command
{
    protected $signature = 'ml:run-customer-segmentation';
    protected $description = 'Run the Python script to generate customer segments';

    public function handle()
    {
        $this->info("Running ML script...");

        $process = new Process(['python', 'ML/customer_segmentation.py']);
        $process->run();

        if ($process->isSuccessful()) {
            $this->info("✅ Python script finished.");
            $this->call('import:customer-segments'); // import CSV into DB
        } else {
            $this->error("❌ Python script failed:");
            $this->error($process->getErrorOutput());
        }

        return 0;
    }
}
