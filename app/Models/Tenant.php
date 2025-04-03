<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
    */
    protected $fillable = ['name', 'domain'];

    /**
     * Get the users associated with the tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the posts associated with the tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
