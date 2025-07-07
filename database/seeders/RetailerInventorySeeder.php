<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RetailerInventory;

class RetailerInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RetailerInventory::create([
            'retailer_id' => 1,
            'product_name' => 'Refined Sugar 1kg',
            'product_id' => 'SUG1001',
            'stock' => 45,
            'unit_price' => 3.50,
            'measurements' => 'kg',
            'status' => 'in_stock',
        ]);
    }
}
