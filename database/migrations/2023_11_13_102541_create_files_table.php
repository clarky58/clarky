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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_id');
            $table->string('path');
            $table->string('is_achieved')->default(false);
            $table->string('folder_id')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->boolean('is_locked')->default(false);
            $table->string('locked_by')->nullable();
            $table->string('locked_at')->nullable();
            $table->string('locked_until')->nullable();
            $table->boolean('is_encrypted')->default(false);
            $table->string('encrypted_by')->nullable();
            $table->string('encrypted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
