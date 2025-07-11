<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop `id` and make `product_id` auto-increment primary key in one step
        DB::statement('ALTER TABLE supplier_inventories DROP COLUMN id, MODIFY product_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY');
    }

    public function down(): void
    {
        // Revert: make product_id normal and restore id as auto-increment primary key
        DB::statement('ALTER TABLE supplier_inventories MODIFY product_id INT UNSIGNED NOT NULL, ADD id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
    }
};
