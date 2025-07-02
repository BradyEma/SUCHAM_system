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
    $table->id(); // Add this line
    $table->unsignedBigInteger('user_id')->unique();
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

    // Supplier-specific fields
    $table->string('business_name')->nullable();
    $table->string('business_type')->nullable();
    $table->string('location')->nullable();
    $table->string('telNo')->nullable();
    $table->string('Tax_ID')->nullable();
    $table->string('TIN')->nullable();
    $table->string('document_path')->nullable();

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
