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
    Schema::table('customer_segments', function (Blueprint $table) {
        $table->string('customers_email')->nullable();
        $table->string('label')->nullable();
    });
}

public function down()
{
    Schema::table('customer_segments', function (Blueprint $table) {
        $table->dropColumn(['customers_email', 'label']);
    });
}

};
