<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Kibale Sugar Farmers Cooperative',
                'email' => 'kibale@sugarcoops.com',
                'verification_status' => 'approved',
                'pdf_path' => null,
            ],
            [
                'name' => 'Bunyoro Growers Ltd',
                'email' => 'bunyoro@growers.com',
                'verification_status' => 'pending',
                'pdf_path' => null,
            ],
            [
                'name' => 'Lira Agro Supplies',
                'email' => 'info@liraagro.com',
                'verification_status' => 'rejected',
                'pdf_path' => null,
            ],
        ];
        $this->call(SupplierSeeder::class);

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
