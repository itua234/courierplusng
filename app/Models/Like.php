<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['post_id', 'user_id'];

    public $timestamps = false;

    /**
     * Get the post associated with the like.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the user associated with the like.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
