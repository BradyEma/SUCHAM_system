<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Database\Seeders\FaqSeeder;
use Illuminate\Database\Seeder;
use App\Models\WholesalerOrder;
use App\Models\Logistics;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
    */


    public function run(): void
    {
        $this->call(FaqSeeder::class);


       
// Create products

         Product::create([
        'name' => 'Light Brown Sugar',
        'image' => 'brown-sugar.jpg',
    ]);

    Product::create([
        'name' => 'White Granulated Sugar',
        'image' => 'white-sugar.jpg',
    ]);

    Product::create([
        'name' => 'Raw Sugar',
        'image' => 'raw-sugar.jpg',
    ]);
    Product::create([
        'name' => 'Sugar Cubes',
        'image' => 'sugarcubes.png',
    ]);
    Product::create([
        'name' => 'Molasses',
        'image' => 'molasses.jpg',
    ]);
    Product::create([
        'name' => 'Bagase',
        'image' => 'bagase.png',
    ]);
    Product::create([
        'name' => 'Sugar Syrup',
        'image' => 'sugar-syrup.jpg',
    ]);

// Example: Create 10 delivery records for existing orders
    $orders = WholesalerOrder::limit(10)->get();

    // Retrieve a logistics admin user (adjust the query as needed for your app)
    $admin = User::where('role', 'logistics_admin')->first();

    foreach ($orders as $order) {
        // Only add a delivery if one doesn't already exist
        if (!$order->delivery && $admin) {
            Logistics::create([
                'order_id' => $order->id,
                'status' => 'pending',
                'assigned_to' => $admin->id, // Assigned to logistics admin
            ]);
        }
    }
}
}