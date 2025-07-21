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
    
        Schema::create('procurement_requests', function (Blueprint $table) {
    $table->id();

    $table->string('request_number')->unique(); // Request #
    $table->date('request_date');               // Request Date
    $table->string('department');               // Department
    $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // Priority
    $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status
    $table->decimal('estimated_cost', 12, 2)->nullable(); // Estimated Cost

    $table->timestamps();
});



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurement_requests');
    }
};
