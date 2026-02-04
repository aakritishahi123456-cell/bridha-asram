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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name');
            $table->string('donor_email');
            $table->string('donor_phone')->nullable();
            $table->text('donor_address')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('NPR');
            $table->enum('purpose', ['homeless_care', 'elderly_care', 'general_fund', 'emergency_relief']);
            $table->enum('payment_method', ['esewa', 'khalti', 'bank_transfer', 'cash']);
            $table->string('transaction_id')->unique()->nullable();
            $table->string('payment_reference')->nullable();
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('receipt_number')->unique()->nullable();
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->json('payment_details')->nullable(); // Store gateway-specific data
            $table->timestamp('payment_completed_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index(['payment_status', 'created_at']);
            $table->index(['purpose', 'payment_status']);
            $table->index(['donor_email', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};