<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin') || $this->isSuperAdmin();
    }

    /**
     * Check if user is volunteer
     */
    public function isVolunteer(): bool
    {
        return $this->hasRole('volunteer');
    }

    /**
     * Get the volunteer profile associated with the user
     */
    public function volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }

    /**
     * Get donations made by this user
     */
    public function donations()
    {
        return $this->hasMany(Donation::class, 'donor_email', 'email');
    }

    /**
     * Get donations processed by this user
     */
    public function processedDonations()
    {
        return $this->hasMany(Donation::class, 'processed_by');
    }

    /**
     * Get blog posts created by this user
     */
    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    /**
     * Get events created by this user
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    /**
     * Get volunteers approved by this user
     */
    public function approvedVolunteers()
    {
        return $this->hasMany(Volunteer::class, 'approved_by');
    }

    /**
     * Get impact metrics recorded by this user
     */
    public function impactMetrics()
    {
        return $this->hasMany(ImpactMetric::class, 'recorded_by');
    }

    /**
     * Get media files uploaded by this user
     */
    public function mediaFiles()
    {
        return $this->hasMany(MediaFile::class, 'uploaded_by');
    }

    /**
     * Get event registrations for this user
     */
    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}