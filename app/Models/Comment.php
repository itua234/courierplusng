<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Comment extends Model
{
    use HasUuids;

    protected $fillable = [
        'content', 
        'user_id', 
        'post_id',
        'tenant_id'
    ];

    /**
     * Get the post associated with the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the user associated with the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
