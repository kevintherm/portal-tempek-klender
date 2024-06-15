<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->boolean('show_on_featured')->default(false);
            $table->foreignId('category_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('type')->default('post');
            $table->string('title');
            $table->string('slug');
            $table->text('body');
            $table->json('attendance_list')->nullable();
            $table->timestamps();
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
