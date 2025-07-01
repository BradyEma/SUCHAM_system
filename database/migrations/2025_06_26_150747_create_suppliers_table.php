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
    Schema::create('suppliers', function (Blueprint $table) {
       $table->unsignedBigInteger('user_id')->unique();
       $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


        // Supplier-specific fields
        $table->string('business_name')->nullable();
        $table->string('business_type')->nullable();      // e.g., Manufacturer, Distributor, etc.
        $table->string('location')->nullable();
        $table->string('telNo')->nullable();              // telephone number
        $table->string('Tax_ID')->nullable();             // replaces license_number
        $table->string('TIN')->nullable();                // Tax Identification Number

        // File upload field (e.g. for PDFs)
        $table->string('document_path')->nullable();      // this will store the path to uploaded PDF

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
