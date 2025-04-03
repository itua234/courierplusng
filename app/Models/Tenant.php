<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function users(): hasMany
    {
        return $this->hasMany(User::class);
    }
}
