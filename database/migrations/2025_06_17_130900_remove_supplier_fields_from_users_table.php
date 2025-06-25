<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            if (Schema::hasColumn('users', 'business_name')) {
                DB::statement('ALTER TABLE users DROP COLUMN business_name');
            }
            if (Schema::hasColumn('users', 'tin_or_nin')) {
                DB::statement('ALTER TABLE users DROP COLUMN tin_or_nin');
            }
            if (Schema::hasColumn('users', 'raw_material')) {
                DB::statement('ALTER TABLE users DROP COLUMN raw_material');
            }
            if (Schema::hasColumn('users', 'verification_file')) {
                DB::statement('ALTER TABLE users DROP COLUMN verification_file');
            }
            if (Schema::hasColumn('users', 'status')) {
                DB::statement('ALTER TABLE users DROP COLUMN status');
            }
            if (Schema::hasColumn('users', 'location')) {
                DB::statement('ALTER TABLE users DROP COLUMN location');
            }
        }
    }

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
