<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Database\Seeders\FaqSeeder;
use Illuminate\Database\Seeder;
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
        // Create admin user
        User::updateOrCreate([
            'name' => 'Admin User',
            'email' => 'admin@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create supplier users
        User::create([
            'name' => 'John Supplier',
            'email' => 'john.supplier@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'supplier',
        ]);

         Product::create([
        'name' => 'Light Brown Sugar',
        'image' => 'brown-sugar.jpg',
    ]);

    Product::create([
        'name' => 'White Granulated Sugar',
        'image' => 'white-sugar.jpg',
    ]);

        User::create([
            'name' => 'Sarah Supplier',
            'email' => 'sarah.supplier@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'supplier',
        ]);

        User::create([
            'name' => 'Mike Supplier',
            'email' => 'mike.supplier@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'supplier',
        ]);

        // Create retailer users
        User::create([
            'name' => 'Lisa Retailer',
            'email' => 'lisa.retailer@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'retailer',
        ]);

        User::create([
            'name' => 'David Retailer',
            'email' => 'david.retailer@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'retailer',
        ]);

        // Create wholesaler users
        User::create([
            'name' => 'Emma Wholesaler',
            'email' => 'emma.wholesaler@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'wholesaler',
        ]);

        User::create([
            'name' => 'Tom Wholesaler',
            'email' => 'tom.wholesaler@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'wholesaler',
        ]);

        // Create customer users
        User::create([
            'name' => 'Anna Customer',
            'email' => 'anna.customer@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'James Customer',
            'email' => 'james.customer@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Maria Customer',
            'email' => 'maria.customer@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Robert Customer',
            'email' => 'robert.customer@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Jennifer Customer',
            'email' => 'jennifer.customer@sucham.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}
