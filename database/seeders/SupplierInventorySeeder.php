<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\SupplierInventory;

class SupplierInventorySeeder extends Seeder
{
    public function run(): void
    {
        // Fetch existing products by SKU
        $product1 = Product::where('product_id', 'SKU-001')->first();
        $product2 = Product::where('product_id', 'SKU-002')->first();
        $product3 = Product::where('product_id', 'SKU-005')->first();

    

        // Create supplier inventories
        SupplierInventory::insert([
            [
                'product' => $product1->product_name,
                'product_id' => $product1->id,
                'unit_price' => 500.00,
                'measurement' => 'kg',
                'status' => 'In Stock',
                'actions' => 'N/A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product' => $product2->product_name,
                'product_id' => $product2->id,
                'unit_price' => 700.00,
                'measurement' => 'liters',
                'status' => 'Low Stock',
                'actions' => 'Order Soon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product' => $product3->product_name,
                'product_id' => $product3->id,
                'unit_price' => 1200.00,
                'measurement' => 'kg',
                'status' => 'Out of Stock',
                'actions' => 'Restock',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
