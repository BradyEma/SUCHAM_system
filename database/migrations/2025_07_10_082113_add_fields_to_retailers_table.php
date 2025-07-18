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
    Schema::table('retailers', function (Blueprint $table) {
        $table->string('tin')->nullable();
        $table->string('status')->default('pending'); // pending, approved, rejected
        $table->string('document_path')->nullable(); // path to uploaded PDF
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('retailers', function (Blueprint $table) {
        $table->dropColumn(['tin', 'status', 'document_path']);
    });
}
};
