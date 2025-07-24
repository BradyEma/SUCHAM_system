<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('retailer_wholesaler_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Shorter column name
            $table->string('product_name');
            $table->decimal('price', 10, 2);
            $table->decimal('quantity', 10, 2);
            $table->string('unit', 20);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            // Add foreign key with custom constraint name
            $table->foreign('order_id', 'fk_order_items_order')
                  ->references('id')
                  ->on('retailer_wholesaler_orders')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('retailer_wholesaler_order_items');
    }
};
