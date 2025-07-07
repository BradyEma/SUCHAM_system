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
        Schema::create('retailer_inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('retailer_id');
            $table->string('product_name');
            $table->string('product_id')->unique();
            $table->integer('stock');
            $table->decimal('unit_price', 10, 2);
            $table->string('measurements');
            $table->enum('status', ['in_stock', 'low_stock', 'out_of_stock'])->default('in_stock');
            $table->timestamps();

            // Optional: Add FK if 'retailers' table exists
            // $table->foreign('retailer_id')->references('id')->on('retailers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retailer_inventories');
    }
};
