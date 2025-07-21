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
    Schema::create('logistics', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('status')->default('active');
        $table->foreignId('created_by')->constrained('users');
        $table->timestamps();
        $table->softDeletes();
        $table->string('current_location')->nullable(); // Current location of goods
            $table->string('destination')->nullable();     // Final destination
            $table->json('route_history')->nullable();     // JSON array of previous locations
            $table->decimal('latitude', 10, 7)->nullable(); // For map coordinates
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamp('estimated_arrival')->nullable();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistics');
    }
};
