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
        Schema::dropIfExists('supplier_inventories');

        Schema::create('supplier_inventories', function (Blueprint $table) {
                  $table->integer('product_id')->autoIncrement(); // This is the new primary key
                  $table->string('product_name');
                  $table->unsignedInteger('quantity');
                  $table->decimal('unit_price', 10, 2);
                  $table->string('unit_of_measurement');
                  $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_inventories');
    }
};
