<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversion_logs', function (Blueprint $table) {
            $table->id();
            $table->string('raw_material');
            $table->string('converted_product');
            $table->integer('amount_used');
            $table->integer('amount_produced');
            $table->timestamp('converted_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversion_logs');
    }
};
