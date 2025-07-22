<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('supplier_inventories', function (Blueprint $table) {
            // Rename columns
            if (Schema::hasColumn('supplier_inventories', 'product')) {
                $table->renameColumn('product', 'product_name');
            }

            if (Schema::hasColumn('supplier_inventories', 'measurement')) {
                $table->renameColumn('measurement', 'unit_of_measurement');
            }

            // Ensure quantity and unit_price exist and are distinct
            if (!Schema::hasColumn('supplier_inventories', 'quantity')) {
                $table->unsignedInteger('quantity')->after('product_id');
            }

            if (!Schema::hasColumn('supplier_inventories', 'unit_price')) {
                $table->decimal('unit_price', 10, 2)->after('quantity');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supplier_inventories', function (Blueprint $table) {
            // Revert renames
            if (Schema::hasColumn('supplier_inventories', 'product_name')) {
                $table->renameColumn('product_name', 'product');
            }

            if (Schema::hasColumn('supplier_inventories', 'unit_of_measurement')) {
                $table->renameColumn('unit_of_measurement', 'measurement');
            }

            // Drop added columns if needed
            if (Schema::hasColumn('supplier_inventories', 'quantity')) {
                $table->dropColumn('quantity');
            }

            if (Schema::hasColumn('supplier_inventories', 'unit_price')) {
                $table->dropColumn('unit_price');
            }
        });
    }
};
