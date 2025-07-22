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
    Schema::table('wholesaler_orders', function (Blueprint $table) {
        // First, drop the foreign key constraint
        $table->dropForeign(['customer_id']);

        // Then drop the column
        $table->dropColumn('customer_id');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wholesaler_orders', function (Blueprint $table) {
            //
        });
    }
};
