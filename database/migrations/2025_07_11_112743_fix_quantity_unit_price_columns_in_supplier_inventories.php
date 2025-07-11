<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('supplier_inventories', function (Blueprint $table) {
            // Drop wrongly combined column if it exists
            if (Schema::hasColumn('supplier_inventories', 'quantity_unit_price')) {
                $table->dropColumn('quantity_unit_price');
            }

            // Add correct individual columns if they don't exist
            if (!Schema::hasColumn('supplier_inventories', 'quantity')) {
                $table->unsignedInteger('quantity')->after('product_id');
            }

            if (!Schema::hasColumn('supplier_inventories', 'unit_price')) {
                $table->decimal('unit_price', 10, 2)->after('quantity');
            }
        });
    }

    public function down(): void
    {
        Schema::table('supplier_inventories', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'unit_price']);

            // Optionally recreate the incorrect column (if needed)
            // $table->string('quantity_unit_price')->nullable();
        });
    }
};
