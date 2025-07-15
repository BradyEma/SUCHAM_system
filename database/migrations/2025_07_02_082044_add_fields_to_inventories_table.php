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
        Schema::table('inventories', function (Blueprint $table) {
        $table->string('SKU')->nullable();
        $table->integer('minimum_stock_level')->nullable();
        $table->string('supplier_email')->nullable();
        $table->string('product_image')->nullable();
        $table->text('product_description')->nullable();
        $table->string('unit_of_measurement')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            //
        });
    }
};
