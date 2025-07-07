<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Drops the 'retailer_id' column from 'retailer_inventories' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retailer_inventories', function (Blueprint $table) {
            if (Schema::hasColumn('retailer_inventories', 'retailer_id')) {
                $table->dropColumn('retailer_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     * Adds the 'retailer_id' column back as unsignedBigInteger.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retailer_inventories', function (Blueprint $table) {
            if (!Schema::hasColumn('retailer_inventories', 'retailer_id')) {
                $table->unsignedBigInteger('retailer_id');
                // Uncomment the following line if you want to add a foreign key constraint:
                // $table->foreign('retailer_id')->references('id')->on('retailers')->onDelete('cascade');
            }
        });
    }
};
