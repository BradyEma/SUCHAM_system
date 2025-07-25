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
    Schema::table('conversations', function (Blueprint $table) {
        $table->unsignedBigInteger('sender_id')->after('id');
        $table->unsignedBigInteger('receiver_id')->after('sender_id');

        // Add foreign keys if needed
        $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('conversations', function (Blueprint $table) {
        $table->dropForeign(['sender_id']);
        $table->dropForeign(['receiver_id']);
        $table->dropColumn(['sender_id', 'receiver_id']);
    });
}

};
