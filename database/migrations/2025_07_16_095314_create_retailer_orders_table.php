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
    Schema::create('retailer_orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('retailer_id'); // linked to retailers table
        $table->unsignedBigInteger('user_id');     // the customer
        $table->unsignedBigInteger('product_id');  // the product
        $table->string('product_image')->nullable();
        $table->string('product_name'); // optional, for display
        $table->integer('quantity');
        $table->decimal('price', 10, 2);
        $table->string('status')->default('pending'); // e.g. pending, approved, delivered
        $table->timestamps();

        // Foreign key constraints (optional but recommended)
        $table->foreign('retailer_id')->references('id')->on('retailers')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retailer_orders');
    }
};
