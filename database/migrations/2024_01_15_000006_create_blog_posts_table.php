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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_nepali')->nullable();
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('excerpt_nepali')->nullable();
            $table->longText('content');
            $table->longText('content_nepali')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('tags')->nullable(); // Array of tags
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('view_count')->default(0);
            $table->integer('sort_order')->default(0);
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index(['is_featured', 'published_at']);
            $table->index(['city_id', 'status']);
            $table->index(['author_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};