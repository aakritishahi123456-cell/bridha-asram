<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_nepali',
        'slug',
        'excerpt',
        'excerpt_nepali',
        'content',
        'content_nepali',
        'featured_image',
        'gallery_images',
        'tags',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'published_at',
        'is_featured',
        'view_count',
        'sort_order',
        'author_id',
        'city_id',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'tags' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'view_count' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blogPost) {
            if (empty($blogPost->slug)) {
                $blogPost->slug = Str::slug($blogPost->title);
            }
        });

        static::updating(function ($blogPost) {
            if ($blogPost->isDirty('title') && empty($blogPost->slug)) {
                $blogPost->slug = Str::slug($blogPost->title);
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
     * Get the author of this blog post
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the city this blog post is related to
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the categories for this blog post
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_post_category');
    }

    /**
     * Scope to get published posts
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope to get featured posts
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get posts by city
     */
    public function scopeByCity($query, int $cityId)
    {
        return $query->where('city_id', $cityId);
    }

    /**
     * Scope to get posts by author
     */
    public function scopeByAuthor($query, int $authorId)
    {
        return $query->where('author_id', $authorId);
    }

    /**
     * Scope to search posts
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('title_nepali', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%")
              ->orWhere('content_nepali', 'like', "%{$search}%")
              ->orWhere('excerpt', 'like', "%{$search}%")
              ->orWhere('excerpt_nepali', 'like', "%{$search}%");
        });
    }

    /**
     * Get the display title (with fallback to English)
     */
    public function getDisplayTitleAttribute(): string
    {
        return $this->title_nepali ?? $this->title;
    }

    /**
     * Get the display excerpt (with fallback to English)
     */
    public function getDisplayExcerptAttribute(): ?string
    {
        return $this->excerpt_nepali ?? $this->excerpt;
    }

    /**
     * Get the display content (with fallback to English)
     */
    public function getDisplayContentAttribute(): string
    {
        return $this->content_nepali ?? $this->content;
    }

    /**
     * Get reading time estimate
     */
    public function getReadingTimeAttribute(): int
    {
        $content = $this->getDisplayContentAttribute();
        $wordCount = str_word_count(strip_tags($content));
        return max(1, ceil($wordCount / 200)); // Assuming 200 words per minute
    }

    /**
     * Check if post is published
     */
    public function isPublished(): bool
    {
        return $this->status === 'published' && $this->published_at <= now();
    }

    /**
     * Check if post is draft
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Increment view count
     */
    public function incrementViews(): void
    {
        $this->increment('view_count');
    }

    /**
     * Publish the post
     */
    public function publish(): void
    {
        $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}