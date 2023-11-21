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
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid')->after('id');
            $table->string('user_name')->unique()->nullable()->after('uuid'); 
            $table->string('image')->nullable()->after('password'); 
            $table->boolean('is_block')->default(false)->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('user_name');
            $table->dropColumn('image');
            $table->dropColumn('is_block');
        });
    }
};
