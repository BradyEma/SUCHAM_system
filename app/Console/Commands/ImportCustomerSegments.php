<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CustomerSegment;
use League\Csv\Reader;

class ImportCustomerSegments extends Command
{
    protected $signature = 'import:customer-segments';
    protected $description = 'Import customer segments from CSV';

    public function handle()
{
    $path = storage_path('app/data/customer_segments.csv');
    if (!file_exists($path)) {
        $this->error('CSV file not found.');
        return;
    }

   $csv = Reader::createFromPath($path, 'r');
$csv->setDelimiter(",");  // 👈 important, your file is comma separated
$csv->setHeaderOffset(0);

foreach ($csv as $row) {
    CustomerSegment::updateOrCreate(
        ['customer_id' => $row['customer_id']],
        [
            'customers_email' => $row['customers_email'],
            'order_amount' => $row['order_amount'],
            'order_count' => $row['order_count'],
            'cluster' => $row['cluster'],
            'label' => $row['label'],
        ]
    );
}


    $this->info('✅ Customer segments imported successfully.');
}

}
