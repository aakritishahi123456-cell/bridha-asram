<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_nepali',
        'slug',
        'description',
        'description_nepali',
        'coordinator_name',
        'coordinator_contact',
        'coordinator_email',
        'address',
        'address_nepali',
        'image_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($city) {
            if (empty($city->slug)) {
                $city->slug = Str::slug($city->name);
            }
        });

        static::updating(function ($city) {
            if ($city->isDirty('name') && empty($city->slug)) {
                $city->slug = Str::slug($city->name);
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
     * Get volunteers in this city
     */
    public function volunteers(): HasMany
    {
        return $this->hasMany(Volunteer::class);
    }

    /**
     * Get events in this city
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Get blog posts related to this city
     */
    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    /**
     * Get impact metrics for this city
     */
    public function impactMetrics(): HasMany
    {
        return $this->hasMany(ImpactMetric::class);
    }

    /**
     * Get media files for this city
     */
    public function mediaFiles(): HasMany
    {
        return $this->hasMany(MediaFile::class);
    }

    /**
     * Scope to get only active cities
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the display name (with fallback to English)
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name_nepali ?? $this->name;
    }

    /**
     * Get the display description (with fallback to English)
     */
    public function getDisplayDescriptionAttribute(): ?string
    {
        return $this->description_nepali ?? $this->description;
    }

    /**
     * Get the display address (with fallback to English)
     */
    public function getDisplayAddressAttribute(): ?string
    {
        return $this->address_nepali ?? $this->address;
    }
}