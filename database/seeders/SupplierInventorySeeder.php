<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SupplierInventory;
use App\Models\Product;
use App\Models\Supplier;


class SupplierInventorySeeder extends Seeder
{
    public function run()
    {
        // Example: get a supplier and its products
        $supplier = Supplier::first(); // Or find() with specific ID

        // Create products if not exist
        $products = [
            ['name' => 'Sugarcane', 'unit' => 'kg', 'quantity' => 1000],
            ['name' => 'Packing Bags', 'unit' => 'pieces', 'quantity' => 500],
            ['name' => 'Molasses', 'unit' => 'litres', 'quantity' => 300],
            ['name' => 'Sugar Beets', 'unit' => 'kg', 'quantity' => 800],
        ];

        foreach ($products as $item) {
            $product = Product::firstOrCreate(['name' => $item['name']]);

            SupplierInventory::create([
                'supplier_id'   => $supplier->id,
                'product_id'    => $product->id,
                'product_name'  => $product->name,
                'quantity'      => $item['quantity'],
                'unit'          => $item['unit'],
            ]);
        }
    }
}
