<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandPredictionsTable extends Migration
{
    public function up()
    {
        Schema::create('demand_predictions', function (Blueprint $table) {
            $table->id();
            $table->string('product')->default('Sugar');
            $table->date('predicted_for');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demand_predictions');
    }
}