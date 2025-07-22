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
        Schema::create('shipments', function (Blueprint $table) {
             $table->id();
    $table->unsignedBigInteger('order_id');
    $table->enum('status', ['pending', 'in_transit', 'delivered', 'failed'])->default('pending');
    $table->date('scheduled_date')->nullable();
    $table->string('driver_name')->nullable();
    $table->string('vehicle_number')->nullable();
    $table->timestamps();

    $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
