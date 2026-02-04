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
        Schema::create('media_files', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('original_filename');
            $table->string('file_path');
            $table->string('file_url')->nullable();
            $table->string('mime_type');
            $table->bigInteger('file_size'); // in bytes
            $table->integer('width')->nullable(); // for images
            $table->integer('height')->nullable(); // for images
            $table->string('alt_text')->nullable();
            $table->string('alt_text_nepali')->nullable();
            $table->text('caption')->nullable();
            $table->text('caption_nepali')->nullable();
            $table->text('description')->nullable();
            $table->text('description_nepali')->nullable();
            $table->enum('media_type', ['image', 'video', 'audio', 'document'])->default('image');
            $table->enum('usage_type', ['blog', 'event', 'gallery', 'program', 'city', 'general'])->default('general');
            $table->string('collection_name')->nullable(); // For grouping related media
            $table->json('metadata')->nullable(); // Additional file metadata
            $table->boolean('is_optimized')->default(false);
            $table->boolean('is_public')->default(true);
            $table->integer('sort_order')->default(0);
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();

            $table->index(['media_type', 'usage_type']);
            $table->index(['collection_name', 'sort_order']);
            $table->index(['city_id', 'media_type']);
            $table->index(['uploaded_by', 'created_at']);
            $table->index(['is_public', 'media_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_files');
    }
};