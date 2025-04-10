<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasUuids;
    //protected $connection = 'tenant';

    protected $fillable = [
        'title', 
        'slug',
        'content', 
        'tenant_id', 
        'user_id',
        'visibility',
        'status',
        'image',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function (Post $post) {
            if ($post->isDirty('title')) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * Get the tenant associated with the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the user associated with the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments associated with the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the likes associated with the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}
