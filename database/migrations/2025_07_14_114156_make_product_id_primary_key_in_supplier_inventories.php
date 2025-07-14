<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Schema\Builder;

class MakeProductIdPrimaryKeyInSupplierInventories extends Migration
{
    public function up()
    {
        // Safely check if the primary key already exists
        $hasPrimaryKey = DB::select("SHOW KEYS FROM supplier_inventories WHERE Key_name = 'PRIMARY'");
        $hasAutoIncrement = DB::select("SHOW COLUMNS FROM supplier_inventories WHERE Field = 'product_id' AND Extra LIKE '%auto_increment%'");

        if (empty($hasPrimaryKey) || empty($hasAutoIncrement)) {
            // Only run these if the key isn't already in place
            DB::statement('ALTER TABLE supplier_inventories DROP PRIMARY KEY');
            DB::statement('ALTER TABLE supplier_inventories MODIFY product_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY');
        }
    }

    public function down()
    {
        // Optional: revert if needed
        DB::statement('ALTER TABLE supplier_inventories DROP PRIMARY KEY');
        DB::statement('ALTER TABLE supplier_inventories MODIFY product_id INT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE supplier_inventories ADD COLUMN id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
    }
}
