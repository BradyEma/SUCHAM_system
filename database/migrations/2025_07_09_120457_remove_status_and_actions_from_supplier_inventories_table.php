<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveStatusAndActionsFromSupplierInventoriesTable extends Migration
{
    public function up()
    {
        Schema::table('supplier_inventories', function (Blueprint $table) {
            $table->dropColumn(['status', 'actions']);
        });
    }

    public function down()
    {
        Schema::table('supplier_inventories', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->string('actions')->nullable();
        });
    }
}
