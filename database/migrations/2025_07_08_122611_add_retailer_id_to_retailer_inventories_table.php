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
    Schema::table('retailer_inventories', function (Blueprint $table) {
        $table->unsignedBigInteger('retailer_id')->after('id'); // adjust position if needed
    });
}

public function down(): void
{
    Schema::table('retailer_inventories', function (Blueprint $table) {
        $table->dropColumn('retailer_id');
    });
}
};
