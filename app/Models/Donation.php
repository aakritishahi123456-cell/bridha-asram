<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name',
        'donor_email',
        'donor_phone',
        'donor_address',
        'amount',
        'currency',
        'purpose',
        'payment_method',
        'transaction_id',
        'payment_reference',
        'payment_status',
        'receipt_number',
        'notes',
        'admin_notes',
        'payment_details',
        'payment_completed_at',
        'processed_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_details' => 'array',
        'payment_completed_at' => 'datetime',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($donation) {
            if (empty($donation->receipt_number)) {
                $donation->receipt_number = 'RCP-' . strtoupper(Str::random(8));
            }
        });
    }

    /**
     * Get the user who processed this donation
     */
    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Get the donor user (if registered)
     */
    public function donor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'donor_email', 'email');
    }

    /**
     * Scope to get completed donations
     */
    public function scopeCompleted($query)
    {
        return $query->where('payment_status', 'completed');
    }

    /**
     * Scope to get pending donations
     */
    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    /**
     * Scope to get donations by purpose
     */
    public function scopeByPurpose($query, string $purpose)
    {
        return $query->where('purpose', $purpose);
    }

    /**
     * Scope to get donations by payment method
     */
    public function scopeByPaymentMethod($query, string $method)
    {
        return $query->where('payment_method', $method);
    }

    /**
     * Get formatted amount with currency
     */
    public function getFormattedAmountAttribute(): string
    {
        return $this->currency . ' ' . number_format($this->amount, 2);
    }

    /**
     * Get human readable purpose
     */
    public function getPurposeDisplayAttribute(): string
    {
        return match($this->purpose) {
            'homeless_care' => 'Homeless Care',
            'elderly_care' => 'Elderly Care',
            'general_fund' => 'General Fund',
            'emergency_relief' => 'Emergency Relief',
            default => ucfirst(str_replace('_', ' ', $this->purpose))
        };
    }

    /**
     * Get human readable payment method
     */
    public function getPaymentMethodDisplayAttribute(): string
    {
        return match($this->payment_method) {
            'esewa' => 'eSewa',
            'khalti' => 'Khalti',
            'bank_transfer' => 'Bank Transfer',
            'cash' => 'Cash',
            default => ucfirst(str_replace('_', ' ', $this->payment_method))
        };
    }

    /**
     * Get human readable status
     */
    public function getStatusDisplayAttribute(): string
    {
        return match($this->payment_status) {
            'pending' => 'Pending',
            'completed' => 'Completed',
            'failed' => 'Failed',
            'refunded' => 'Refunded',
            default => ucfirst($this->payment_status)
        };
    }

    /**
     * Check if donation is completed
     */
    public function isCompleted(): bool
    {
        return $this->payment_status === 'completed';
    }

    /**
     * Check if donation is pending
     */
    public function isPending(): bool
    {
        return $this->payment_status === 'pending';
    }

    /**
     * Mark donation as completed
     */
    public function markAsCompleted(?int $processedBy = null): void
    {
        $this->update([
            'payment_status' => 'completed',
            'payment_completed_at' => now(),
            'processed_by' => $processedBy,
        ]);
    }
}