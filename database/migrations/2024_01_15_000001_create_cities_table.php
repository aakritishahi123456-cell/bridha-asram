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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_nepali')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('description_nepali')->nullable();
            $table->string('coordinator_name')->nullable();
            $table->string('coordinator_contact')->nullable();
            $table->string('coordinator_email')->nullable();
            $table->text('address')->nullable();
            $table->text('address_nepali')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};