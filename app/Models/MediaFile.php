<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class MediaFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'original_filename',
        'file_path',
        'file_url',
        'mime_type',
        'file_size',
        'width',
        'height',
        'alt_text',
        'alt_text_nepali',
        'caption',
        'caption_nepali',
        'description',
        'description_nepali',
        'media_type',
        'usage_type',
        'collection_name',
        'metadata',
        'is_optimized',
        'is_public',
        'sort_order',
        'uploaded_by',
        'city_id',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'metadata' => 'array',
        'is_optimized' => 'boolean',
        'is_public' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the user who uploaded this file
     */
    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get the city this media file belongs to
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Scope to get public files
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope to get files by media type
     */
    public function scopeByMediaType($query, string $type)
    {
        return $query->where('media_type', $type);
    }

    /**
     * Scope to get files by usage type
     */
    public function scopeByUsageType($query, string $type)
    {
        return $query->where('usage_type', $type);
    }

    /**
     * Scope to get files by collection
     */
    public function scopeByCollection($query, string $collection)
    {
        return $query->where('collection_name', $collection);
    }

    /**
     * Scope to get files by city
     */
    public function scopeByCity($query, int $cityId)
    {
        return $query->where('city_id', $cityId);
    }

    /**
     * Scope to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }

    /**
     * Get the full URL for the file
     */
    public function getUrlAttribute(): string
    {
        if ($this->file_url) {
            return $this->file_url;
        }

        return Storage::url($this->file_path);
    }

    /**
     * Get the display alt text (with fallback to English)
     */
    public function getDisplayAltTextAttribute(): ?string
    {
        return $this->alt_text_nepali ?? $this->alt_text;
    }

    /**
     * Get the display caption (with fallback to English)
     */
    public function getDisplayCaptionAttribute(): ?string
    {
        return $this->caption_nepali ?? $this->caption;
    }

    /**
     * Get the display description (with fallback to English)
     */
    public function getDisplayDescriptionAttribute(): ?string
    {
        return $this->description_nepali ?? $this->description;
    }

    /**
     * Get human readable file size
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get human readable media type
     */
    public function getMediaTypeDisplayAttribute(): string
    {
        return match($this->media_type) {
            'image' => 'Image',
            'video' => 'Video',
            'audio' => 'Audio',
            'document' => 'Document',
            default => ucfirst($this->media_type)
        };
    }

    /**
     * Get human readable usage type
     */
    public function getUsageTypeDisplayAttribute(): string
    {
        return match($this->usage_type) {
            'blog' => 'Blog',
            'event' => 'Event',
            'gallery' => 'Gallery',
            'program' => 'Program',
            'city' => 'City',
            'general' => 'General',
            default => ucfirst($this->usage_type)
        };
    }

    /**
     * Check if file is an image
     */
    public function isImage(): bool
    {
        return $this->media_type === 'image';
    }

    /**
     * Check if file is a video
     */
    public function isVideo(): bool
    {
        return $this->media_type === 'video';
    }

    /**
     * Check if file is audio
     */
    public function isAudio(): bool
    {
        return $this->media_type === 'audio';
    }

    /**
     * Check if file is a document
     */
    public function isDocument(): bool
    {
        return $this->media_type === 'document';
    }

    /**
     * Get image dimensions as string
     */
    public function getDimensionsAttribute(): ?string
    {
        if ($this->width && $this->height) {
            return "{$this->width} × {$this->height}";
        }

        return null;
    }

    /**
     * Delete the file from storage when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($mediaFile) {
            if (Storage::exists($mediaFile->file_path)) {
                Storage::delete($mediaFile->file_path);
            }
        });
    }
}