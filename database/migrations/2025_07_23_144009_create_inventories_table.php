<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('product'); // final product
            $table->integer('quantity')->default(0); // in units
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
