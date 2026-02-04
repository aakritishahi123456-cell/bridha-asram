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
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('participant_name');
            $table->string('participant_email');
            $table->string('participant_phone');
            $table->text('participant_address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('occupation')->nullable();
            $table->text('special_requirements')->nullable();
            $table->text('motivation')->nullable();
            $table->enum('status', ['registered', 'confirmed', 'attended', 'cancelled'])->default('registered');
            $table->timestamp('registered_at')->useCurrent();
            $table->timestamp('confirmed_at')->nullable();
            $table->decimal('payment_amount', 8, 2)->default(0);
            $table->enum('payment_status', ['pending', 'paid', 'refunded'])->default('pending');
            $table->string('payment_reference')->nullable();
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();

            $table->unique(['event_id', 'participant_email']);
            $table->index(['event_id', 'status']);
            $table->index(['participant_email', 'status']);
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};