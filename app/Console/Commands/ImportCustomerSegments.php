<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CustomerSegment;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class ImportCustomerSegments extends Command
{
    protected $signature = 'import:customer-segments';
    protected $description = 'Import customer_segments.csv into the database';

    public function handle()
    {
        $path = storage_path('app/data/customer_segments.csv');

        if (!file_exists($path)) {
            $this->error('CSV file not found.');
            return 1;
        }

        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        $this->info("Importing customer segments...");

        foreach ($csv as $record) {
            CustomerSegment::updateOrCreate(
                ['customer_id' => $record['customer_id']],
                [
                    'order_amount' => $record['order_amount'],
                    'order_count' => $record['order_count'],
                    'cluster' => $record['cluster'],
                ]
            );
        }

        $this->info("✅ Import complete.");
        return 0;
    }
}
