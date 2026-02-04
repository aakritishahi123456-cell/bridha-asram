<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city_id',
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'address_nepali',
        'occupation',
        'education',
        'skills',
        'availability',
        'motivation',
        'experience',
        'preferred_programs',
        'emergency_contact_name',
        'emergency_contact_phone',
        'status',
        'rejection_reason',
        'approved_by',
        'approved_at',
        'last_activity_at',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'preferred_programs' => 'array',
        'approved_at' => 'datetime',
        'last_activity_at' => 'datetime',
    ];

    /**
     * Get the user associated with this volunteer
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the city this volunteer is associated with
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the user who approved this volunteer
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope to get pending volunteers
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get approved volunteers
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get active volunteers
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['approved']);
    }

    /**
     * Scope to get volunteers by city
     */
    public function scopeByCity($query, int $cityId)
    {
        return $query->where('city_id', $cityId);
    }

    /**
     * Get human readable status
     */
    public function getStatusDisplayAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pending Approval',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'inactive' => 'Inactive',
            default => ucfirst($this->status)
        };
    }

    /**
     * Get age from date of birth
     */
    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth?->age;
    }

    /**
     * Get preferred programs as models
     */
    public function getPreferredProgramModelsAttribute()
    {
        if (!$this->preferred_programs) {
            return collect();
        }

        return Program::whereIn('id', $this->preferred_programs)->get();
    }

    /**
     * Check if volunteer is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if volunteer is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if volunteer is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Approve the volunteer
     */
    public function approve(?int $approvedBy = null): void
    {
        $this->update([
            'status' => 'approved',
            'approved_by' => $approvedBy,
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);
    }

    /**
     * Reject the volunteer
     */
    public function reject(string $reason, ?int $rejectedBy = null): void
    {
        $this->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
            'approved_by' => $rejectedBy,
            'approved_at' => now(),
        ]);
    }

    /**
     * Update last activity
     */
    public function updateActivity(): void
    {
        $this->update(['last_activity_at' => now()]);
    }
}