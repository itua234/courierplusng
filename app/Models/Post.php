<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Post extends Model
{
    protected $fillable = [
        'title', 
        'uuid',
        'content', 
        'tenant_id', 
        'user_id', 
        'attachments'
    ];

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
     * Get the attachments associated with the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
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
