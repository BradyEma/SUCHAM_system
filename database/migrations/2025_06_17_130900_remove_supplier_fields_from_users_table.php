<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            if (Schema::hasColumn('users', 'business_name')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('business_name');
                });
            }
            if (Schema::hasColumn('users', 'tin_or_nin')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('tin_or_nin');
                });
            }
            // Repeat for raw_material, verification_file, status, location...
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'business_name')) {
            $table->string('business_name')->nullable();
        }
        if (!Schema::hasColumn('users', 'tin_or_nin')) {
            $table->string('tin_or_nin')->nullable();
        }
        if (!Schema::hasColumn('users', 'raw_material')) {
            $table->string('raw_material')->nullable();
        }
        if (!Schema::hasColumn('users', 'verification_file')) {
            $table->string('verification_file')->nullable();
        }
        if (!Schema::hasColumn('users', 'status')) {
            $table->string('status')->default('pending');
        }
        if (!Schema::hasColumn('users', 'location')) {
            $table->string('location')->nullable();
        }
    });
    }
};
