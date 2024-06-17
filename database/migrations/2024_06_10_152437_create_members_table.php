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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('position')->nullable();
            $table->string('status')->default('kepala keluarga');
            $table->foreignId('member_id')->nullable()->constrained('members')->onDelete('cascade'); // id kepala keluarga
            $table->string('name');
            $table->integer('age');
            $table->string('job');
            $table->string('address');
            $table->string('phone')->unique();
            $table->text('reason_to_join');
            $table->boolean('is_dead')->default(false);
            $table->timestamp('joined_at')->nullable();
            $table->text('photo')->nullable();
            $table->timestamps();

            $table->index('member_id'); // Index for the foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
