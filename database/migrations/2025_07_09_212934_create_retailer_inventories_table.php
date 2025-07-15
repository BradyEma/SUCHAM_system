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
$table->unsignedBigInteger('retailer_id'); // foreign key to retailers table
$table->string('product_name');
$table->string('sku')->unique();
$table->integer('quantity');
$table->string('unit_of_measurement');
$table->decimal('unit_price', 10, 2);
$table->integer('minimum_stock_level')->default(0);
$table->text('product_description')->nullable();
$table->string('product_image')->nullable();
$table->timestamps();

// Add the foreign key constraint
$table->foreign('retailer_id')->references('id')->on('retailers')->onDelete('cascade');

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
