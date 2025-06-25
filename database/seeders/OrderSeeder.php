<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $csv = Reader::createFromPath(storage_path('app/data/MOCK_DATA.csv'), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            DB::table('orders')->insert([
                'order_id' => $record['order_id'],
                'customer_id' => $record['customer_id'],
                'product' => $record['product'],
                'quantity' => $record['quantity'],
                'order_date' => date('Y-m-d', strtotime($record['order_date'])),
                'status' => $record['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
