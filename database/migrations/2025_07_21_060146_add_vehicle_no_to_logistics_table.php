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
    Schema::table('logistics', function (Blueprint $table) {
        $table->string('vehicle_no')->nullable();
    });
}

public function down()
{
    Schema::table('logistics', function (Blueprint $table) {
        $table->dropColumn('vehicle_no');
    });
}

};
