<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_suppliers_table.php

public function up()
{
    Schema::create('suppliers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('business_name');
        $table->string('email')->unique();
        $table->string('raw_material');
        $table->string('tin_or_nin');
        $table->string('location');
        $table->string('verification_file');
        $table->string('password');
        $table->enum('status', ['pending', 'approved'])->default('pending'); // 👈 add this
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
