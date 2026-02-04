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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_nepali')->nullable();
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('description_nepali')->nullable();
            $table->text('objectives')->nullable();
            $table->text('objectives_nepali')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
            $table->string('venue');
            $table->string('venue_nepali')->nullable();
            $table->text('venue_address')->nullable();
            $table->text('venue_address_nepali')->nullable();
            $table->integer('max_participants')->nullable();
            $table->integer('current_participants')->default(0);
            $table->decimal('registration_fee', 8, 2)->default(0);
            $table->boolean('requires_registration')->default(false);
            $table->datetime('registration_deadline')->nullable();
            $table->text('requirements')->nullable();
            $table->text('requirements_nepali')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->enum('status', ['draft', 'published', 'ongoing', 'completed', 'cancelled'])->default('draft');
            $table->enum('event_type', ['workshop', 'seminar', 'community_service', 'fundraising', 'awareness', 'other'])->default('other');
            $table->boolean('is_featured')->default(false);
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('program_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->index(['status', 'start_date']);
            $table->index(['city_id', 'status']);
            $table->index(['program_id', 'status']);
            $table->index(['event_type', 'start_date']);
            $table->index(['is_featured', 'start_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};