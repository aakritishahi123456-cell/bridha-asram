<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
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
        'featured_image',
        'gallery_images',
        'start_date',
        'end_date',
        'venue',
        'venue_nepali',
        'venue_address',
        'venue_address_nepali',
        'max_participants',
        'current_participants',
        'registration_fee',
        'requires_registration',
        'registration_deadline',
        'requirements',
        'requirements_nepali',
        'contact_person',
        'contact_phone',
        'contact_email',
        'status',
        'event_type',
        'is_featured',
        'city_id',
        'program_id',
        'created_by',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'max_participants' => 'integer',
        'current_participants' => 'integer',
        'registration_fee' => 'decimal:2',
        'requires_registration' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });

        static::updating(function ($event) {
            if ($event->isDirty('title') && empty($event->slug)) {
                $event->slug = Str::slug($event->title);
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
     * Get the city this event belongs to
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the program this event belongs to
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get the user who created this event
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get registrations for this event
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    /**
     * Get confirmed registrations for this event
     */
    public function confirmedRegistrations(): HasMany
    {
        return $this->registrations()->where('status', 'confirmed');
    }

    /**
     * Scope to get published events
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope to get upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    /**
     * Scope to get ongoing events
     */
    public function scopeOngoing($query)
    {
        return $query->where('start_date', '<=', now())
                    ->where(function ($q) {
                        $q->whereNull('end_date')
                          ->orWhere('end_date', '>=', now());
                    });
    }

    /**
     * Scope to get past events
     */
    public function scopePast($query)
    {
        return $query->where(function ($q) {
            $q->where('end_date', '<', now())
              ->orWhere(function ($subQ) {
                  $subQ->whereNull('end_date')
                       ->where('start_date', '<', now()->subDay());
              });
        });
    }

    /**
     * Scope to get featured events
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get events by city
     */
    public function scopeByCity($query, int $cityId)
    {
        return $query->where('city_id', $cityId);
    }

    /**
     * Scope to get events by program
     */
    public function scopeByProgram($query, int $programId)
    {
        return $query->where('program_id', $programId);
    }

    /**
     * Scope to get events by type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('event_type', $type);
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
     * Get the display venue (with fallback to English)
     */
    public function getDisplayVenueAttribute(): string
    {
        return $this->venue_nepali ?? $this->venue;
    }

    /**
     * Get available spots
     */
    public function getAvailableSpotsAttribute(): ?int
    {
        if (!$this->max_participants) {
            return null;
        }

        return max(0, $this->max_participants - $this->current_participants);
    }

    /**
     * Check if event is full
     */
    public function isFull(): bool
    {
        if (!$this->max_participants) {
            return false;
        }

        return $this->current_participants >= $this->max_participants;
    }

    /**
     * Check if registration is open
     */
    public function isRegistrationOpen(): bool
    {
        if (!$this->requires_registration) {
            return false;
        }

        if ($this->registration_deadline && $this->registration_deadline < now()) {
            return false;
        }

        if ($this->start_date < now()) {
            return false;
        }

        return !$this->isFull();
    }

    /**
     * Check if event is upcoming
     */
    public function isUpcoming(): bool
    {
        return $this->start_date > now();
    }

    /**
     * Check if event is ongoing
     */
    public function isOngoing(): bool
    {
        $now = now();
        return $this->start_date <= $now && 
               ($this->end_date === null || $this->end_date >= $now);
    }

    /**
     * Check if event is past
     */
    public function isPast(): bool
    {
        if ($this->end_date) {
            return $this->end_date < now();
        }

        return $this->start_date < now()->subDay();
    }

    /**
     * Get human readable event type
     */
    public function getTypeDisplayAttribute(): string
    {
        return match($this->event_type) {
            'workshop' => 'Workshop',
            'seminar' => 'Seminar',
            'community_service' => 'Community Service',
            'fundraising' => 'Fundraising',
            'awareness' => 'Awareness Campaign',
            'other' => 'Other',
            default => ucfirst(str_replace('_', ' ', $this->event_type))
        };
    }

    /**
     * Get human readable status
     */
    public function getStatusDisplayAttribute(): string
    {
        return match($this->status) {
            'draft' => 'Draft',
            'published' => 'Published',
            'ongoing' => 'Ongoing',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            default => ucfirst($this->status)
        };
    }
}