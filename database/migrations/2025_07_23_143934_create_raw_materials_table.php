<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('material_name');
            $table->integer('quantity')->default(0); // in kg or units
            $table->integer('reorder_threshold')->default(100);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
