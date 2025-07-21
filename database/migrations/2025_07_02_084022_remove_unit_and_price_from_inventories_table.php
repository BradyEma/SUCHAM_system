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
       Schema::table('inventories', function (Blueprint $table) {
        $table->dropColumn(['unit', 'price']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
        $table->string('unit')->nullable(); // or original type
        $table->decimal('price', 10, 2)->nullable(); // or original type
    });
    }
};
