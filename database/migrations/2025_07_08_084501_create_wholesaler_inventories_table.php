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
        Schema::create('wholesaler_inventories', function (Blueprint $table) {
            $table->id();

            // No foreign key constraint on product_id
            $table->string('product_id');
            $table->string('product_name');
            $table->integer('quantity')->default(0);
            $table->enum('units', ['kg', 'litres', 'bags']);
            $table->decimal('unit_price', 10, 2);
            $table->enum('status', ['in_stock', 'out_of_stock'])->default('in_stock');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wholesaler_inventories');
    }
};
