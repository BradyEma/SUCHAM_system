<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetailerOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('retailer_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('retailer_order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('price_per_unit', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            $table->foreign('retailer_order_id')->references('id')->on('retailer_orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('retailer_order_items');
    }
}
