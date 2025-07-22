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
        $table->string('route')->nullable(); // Or use appropriate type
    });
}

public function down()
{
    Schema::table('logistics', function (Blueprint $table) {
        $table->dropColumn('route');
    });
}

};
