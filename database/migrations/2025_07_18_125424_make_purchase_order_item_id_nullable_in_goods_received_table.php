<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePurchaseOrderItemIdNullableInGoodsReceivedTable extends Migration
{
    public function up()
    {
        Schema::table('goods_received', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_order_item_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('goods_received', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_order_item_id')->nullable(false)->change();
        });
    }
}
