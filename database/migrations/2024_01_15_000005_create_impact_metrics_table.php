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
        Schema::create('impact_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('metric_name');
            $table->string('metric_name_nepali')->nullable();
            $table->bigInteger('metric_value');
            $table->string('metric_unit')->nullable();
            $table->string('metric_unit_nepali')->nullable();
            $table->text('description')->nullable();
            $table->text('description_nepali')->nullable();
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('program_id')->nullable()->constrained()->onDelete('set null');
            $table->date('recorded_date');
            $table->enum('metric_type', ['cumulative', 'periodic', 'current'])->default('cumulative');
            $table->boolean('is_featured')->default(false); // For homepage display
            $table->integer('display_order')->default(0);
            $table->foreignId('recorded_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index(['metric_name', 'recorded_date']);
            $table->index(['city_id', 'program_id', 'recorded_date']);
            $table->index(['is_featured', 'display_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impact_metrics');
    }
};