<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'participant_name',
        'participant_email',
        'participant_phone',
        'participant_address',
        'date_of_birth',
        'gender',
        'occupation',
        'special_requirements',
        'motivation',
        'status',
        'registered_at',
        'confirmed_at',
        'payment_amount',
        'payment_status',
        'payment_reference',
        'notes',
        'admin_notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'registered_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'payment_amount' => 'decimal:2',
    ];

    /**
     * Get the event this registration belongs to
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the user who registered (if logged in)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get confirmed registrations
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope to get attended registrations
     */
    public function scopeAttended($query)
    {
        return $query->where('status', 'attended');
    }

    /**
     * Scope to get registrations by event
     */
    public function scopeByEvent($query, int $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    /**
     * Get age from date of birth
     */
    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth?->age;
    }

    /**
     * Get human readable status
     */
    public function getStatusDisplayAttribute(): string
    {
        return match($this->status) {
            'registered' => 'Registered',
            'confirmed' => 'Confirmed',
            'attended' => 'Attended',
            'cancelled' => 'Cancelled',
            default => ucfirst($this->status)
        };
    }

    /**
     * Get human readable payment status
     */
    public function getPaymentStatusDisplayAttribute(): string
    {
        return match($this->payment_status) {
            'pending' => 'Pending',
            'paid' => 'Paid',
            'refunded' => 'Refunded',
            default => ucfirst($this->payment_status)
        };
    }

    /**
     * Check if registration is confirmed
     */
    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    /**
     * Check if participant attended
     */
    public function hasAttended(): bool
    {
        return $this->status === 'attended';
    }

    /**
     * Confirm the registration
     */
    public function confirm(): void
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);
    }

    /**
     * Mark as attended
     */
    public function markAttended(): void
    {
        $this->update([
            'status' => 'attended',
        ]);
    }

    /**
     * Cancel the registration
     */
    public function cancel(): void
    {
        $this->update([
            'status' => 'cancelled',
        ]);
    }
}