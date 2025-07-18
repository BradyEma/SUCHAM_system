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
    Schema::create('vendor_validations', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('supplier_id'); // links to users table
        $table->string('brn');
        $table->decimal('annual_revenue', 15, 2);
        $table->decimal('net_profit_margin', 5, 2);
        $table->integer('years_of_operation');
        $table->decimal('customer_rating', 2, 1);
        $table->string('tax_clearance');
        $table->string('background_check');
        $table->string('financial_stability');
        $table->string('reputation');
        $table->string('regulatory_compliance');
        $table->string('pdf_path');
        $table->text('validation_result')->nullable(); // store JSON or message
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_validations');
    }
};
