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
        $table->unsignedBigInteger('customer_id');
        $table->unsignedBigInteger('product_id');
        $table->integer('quantity');
        $table->decimal('total', 10, 2);
        $table->string('status')->default('pending');
        $table->string('transaction_id')->unique();
        $table->timestamps();

        $table->foreign('wholesaler_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
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
