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
       Schema::create('goods_received', function (Blueprint $table) {
    $table->id();
    $table->foreignId('purchase_order_item_id')->constrained()->onDelete('cascade');
    $table->integer('quantity_received');
    $table->date('received_date');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_received');
    }
};
