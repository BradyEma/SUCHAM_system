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
        // Drop the table if it already exists
        Schema::dropIfExists('supplier_inventories');

        // Create the new supplier_inventories table
        Schema::create('supplier_inventories', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('product');         // PRODUCT
            $table->unsignedBigInteger('product_id'); // FK to products.id
      // PRODUCT_ID
            $table->decimal('unit_price', 10, 2); // UNIT_PRICE
            $table->string('measurement');     // MEASUREMENT
            $table->string('status');          // STATUS
            $table->string('actions')->nullable(); // ACTIONS (optional field)
            $table->timestamps(); // created_at and updated_at

              $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drops the table if you rollback
        Schema::dropIfExists('supplier_inventories');
    }
};
