<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetailerOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('retailer_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('retailer_id');  // FK to retailers/users
            $table->unsignedBigInteger('wholesaler_id'); // FK to wholesalers
            $table->enum('order_status', ['Pending', 'Approved', 'Shipped', 'Delivered', 'Cancelled'])->default('Pending');
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->date('order_date');
            $table->date('delivery_date')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('retailer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('wholesaler_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('retailer_orders');
    }
}
