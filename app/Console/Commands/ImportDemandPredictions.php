<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DemandPrediction;
use League\Csv\Reader;

class ImportDemandPredictions extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'import:demand-predictions';

    /**
     * The console command description.
     */
    protected $description = 'Import demand predictions from CSV into the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = storage_path('app/data/demand_predictions.csv');

        if (!file_exists($path)) {
            $this->error("CSV file not found at: {$path}");
            return 1;
        }

        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $row) {
            DemandPrediction::updateOrCreate(
                [
                    'product' => $row['product'],
                    'predicted_for' => $row['predicted_for']
                ],
                [
                    'quantity' => $row['quantity']
                ]
            );
        }

        $this->info("✅ Demand predictions imported successfully.");
        return 0;
    }
}
