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
        Schema::table('vendor_validations', function (Blueprint $table) {
            // Make sure the column is unsignedBigInteger and change if necessary
            $table->unsignedBigInteger('supplier_id')->change();

            // Add the foreign key constraint
            $table->foreign('supplier_id')
                  ->references('user_id')->on('suppliers')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_validations', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['supplier_id']);
        });
    }
};
