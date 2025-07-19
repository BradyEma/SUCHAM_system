<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunCustomerSegmentation extends Command
{
    protected $signature = 'segments:run';
    protected $description = 'Run the customer segmentation ML script';

    public function handle()
    {
        $scriptPath = base_path('ML/customer_segmentation.py');
        $exitCode = null;

        exec("python \"$scriptPath\"", $output, $exitCode);

        $this->info("Segmentation script completed with exit code $exitCode.");
        return $exitCode;
    }
}
