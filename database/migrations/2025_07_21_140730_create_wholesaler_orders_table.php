<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('wholesaler_orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('wholesaler_id');
        $table->foreignId('order_id')->nullable()->constrained('orders');
        $table->foreignId('product_id')->constrained('products');
        $table->integer('quantity');
        $table->decimal('total', 10, 2);
        $table->string('status')->default('pending');
        $table->string('transaction_id')->unique();
        $table->unsignedBigInteger('product_id');
        $table->integer('quantity');
        $table->decimal('total', 10, 2);
        $table->string('status')->default('pending');
        $table->string('transaction_id')->unique();
        $table->timestamps();

        $table->foreign('wholesaler_id')->references('id')->on('users')->onDelete('cascade');
       
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wholesaler_orders');
    }
};
