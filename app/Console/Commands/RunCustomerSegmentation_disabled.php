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

        // exec("python \"$scriptPath\"", $output, $exitCode);
        $this->info("Simulating segmentation script (python disabled).");
        $exitCode = 0;


       if ($exitCode === 0) {
            // ✅ CSV import logic here
            $csvPath = storage_path('app/data/customer_segments.csv');
            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0);

            CustomerSegment::truncate(); // Clear old data
            foreach ($csv as $record) {
                CustomerSegment::create([
                    'customer_id' => $record['customer_id'],
                    'customers_email' => $record['customers_email'],
                    'order_amount' => $record['order_amount'],
                    'order_count' => $record['order_count'],
                    'cluster' => $record['cluster'],
                    'label' => $record['label'],
                ]);
            }

            $this->info('✔ Customer segments imported into database.');
        } else {
            $this->error("❌ Python script failed with exit code $exitCode");
        }
        return $exitCode;

    }
}
