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
        Schema::create('posts', function (Blueprint $table) {

            $table->id();
            $table->integer('user_id');
            $table->uuid('post_uuid'); 
            $table->text('description')->nullable();
            $table->bigInteger('view_count')->default(0);
            $table->text('viewed_by')->nullable();
            $table->string('image')->nullable();
            $table->integer('total_comment')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
