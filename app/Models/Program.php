<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_nepali',
        'slug',
        'description',
        'description_nepali',
        'objectives',
        'objectives_nepali',
        'image_path',
        'gallery_images',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($program) {
            if (empty($program->slug)) {
                $program->slug = Str::slug($program->title);
            }
        });

        static::updating(function ($program) {
            if ($program->isDirty('title') && empty($program->slug)) {
                $program->slug = Str::slug($program->title);
            }
        });
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get events for this program
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Get impact metrics for this program
     */
    public function impactMetrics(): HasMany
    {
        return $this->hasMany(ImpactMetric::class);
    }

    /**
     * Scope to get only active programs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    /**
     * Get the display title (with fallback to English)
     */
    public function getDisplayTitleAttribute(): string
    {
        return $this->title_nepali ?? $this->title;
    }

    /**
     * Get the display description (with fallback to English)
     */
    public function getDisplayDescriptionAttribute(): string
    {
        return $this->description_nepali ?? $this->description;
    }

    /**
     * Get the display objectives (with fallback to English)
     */
    public function getDisplayObjectivesAttribute(): ?string
    {
        return $this->objectives_nepali ?? $this->objectives;
    }
}