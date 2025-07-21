<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class RunDemandPrediction extends Command
{
    protected $signature = 'ml:run-demand-prediction';
    protected $description = 'Run Python script to forecast sugar demand';

    public function handle()
    {
        $this->info("Running ML demand prediction...");

        $process = new Process(['python', 'ML/demand_prediction.py']);
        $process->run();

        if ($process->isSuccessful()) {
            $this->info("✅ Python script ran successfully.");
            $this->call('import:demand-predictions');
        } else {
            $this->error("❌ Error:");
            $this->error($process->getErrorOutput());
        }

        return 0;
    }
}
