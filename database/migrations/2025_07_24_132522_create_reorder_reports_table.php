<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReorderReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reorder_reports', function (Blueprint $table) {
            $table->id();
            $table->string('material_name');
            $table->integer('quantity_requested');
            $table->string('requested_by')->nullable(); // e.g., 'System'
            $table->timestamp('requested_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reorder_reports');
    }
}