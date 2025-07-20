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
    Schema::table('carts', function (Blueprint $table) {
        $table->unsignedBigInteger('product_id')->nullable()->after('id');
        $table->string('product_image')->nullable()->after('product_name');
    });
}

public function down()
{
    Schema::table('carts', function (Blueprint $table) {
        $table->dropColumn(['product_id', 'product_image']);
    });
}

};
