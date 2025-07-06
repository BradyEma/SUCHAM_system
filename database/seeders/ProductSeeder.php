<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'product_name' => 'Sugarcane',
                'product_id' => 'SKU-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Molasses',
                'product_id' => 'SKU-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Sugar Beets',
                'product_id' => 'SKU-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Packing Bags',
                'product_id' => 'SKU-004',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
    'product_name' => 'Honey',
    'product_id' => 'SKU-005',
    'created_at' => now(),
    'updated_at' => now(),
],

        ]);
    }
}
