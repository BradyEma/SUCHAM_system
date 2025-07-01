<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
      Schema::table('suppliers', function (Blueprint $table) {
        $table->dropColumn('is_approved'); // Remove the old column
        $table->string('status')->default('pending'); // Add new column with default value
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
         Schema::table('suppliers', function (Blueprint $table) {
        $table->boolean('is_approved')->default(false); // Restore old column if rolling back
        $table->dropColumn('status'); // Remove the new column
    });
    }
};
