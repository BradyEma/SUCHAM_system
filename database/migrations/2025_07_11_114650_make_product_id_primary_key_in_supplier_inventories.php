<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Drop 'id' column first
        Schema::table('supplier_inventories', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        // Step 2: Modify 'product_id' to be auto-increment and primary key
        DB::statement('ALTER TABLE supplier_inventories MODIFY product_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY');
    }

    public function down(): void
    {
        // Step 1: Drop primary key on product_id
        DB::statement('ALTER TABLE supplier_inventories MODIFY product_id INT NOT NULL');

        // Step 2: Re-add 'id' column
        Schema::table('supplier_inventories', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
        });
    }
};
