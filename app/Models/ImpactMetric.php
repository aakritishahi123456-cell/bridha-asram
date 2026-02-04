<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImpactMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'metric_name',
        'metric_name_nepali',
        'metric_value',
        'metric_unit',
        'metric_unit_nepali',
        'description',
        'description_nepali',
        'city_id',
        'program_id',
        'recorded_date',
        'metric_type',
        'is_featured',
        'display_order',
        'recorded_by',
    ];

    protected $casts = [
        'metric_value' => 'integer',
        'recorded_date' => 'date',
        'is_featured' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Get the city this metric belongs to
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the program this metric belongs to
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get the user who recorded this metric
     */
    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    /**
     * Scope to get featured metrics
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get metrics by type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('metric_type', $type);
    }

    /**
     * Scope to get metrics by city
     */
    public function scopeByCity($query, int $cityId)
    {
        return $query->where('city_id', $cityId);
    }

    /**
     * Scope to get metrics by program
     */
    public function scopeByProgram($query, int $programId)
    {
        return $query->where('program_id', $programId);
    }

    /**
     * Scope to order by display order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('metric_name');
    }

    /**
     * Get the display name (with fallback to English)
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->metric_name_nepali ?? $this->metric_name;
    }

    /**
     * Get the display unit (with fallback to English)
     */
    public function getDisplayUnitAttribute(): ?string
    {
        return $this->metric_unit_nepali ?? $this->metric_unit;
    }

    /**
     * Get the display description (with fallback to English)
     */
    public function getDisplayDescriptionAttribute(): ?string
    {
        return $this->description_nepali ?? $this->description;
    }

    /**
     * Get formatted metric value
     */
    public function getFormattedValueAttribute(): string
    {
        $value = number_format($this->metric_value);
        $unit = $this->getDisplayUnitAttribute();
        
        return $unit ? "$value $unit" : $value;
    }

    /**
     * Get human readable metric type
     */
    public function getTypeDisplayAttribute(): string
    {
        return match($this->metric_type) {
            'cumulative' => 'Cumulative',
            'periodic' => 'Periodic',
            'current' => 'Current',
            default => ucfirst($this->metric_type)
        };
    }
}