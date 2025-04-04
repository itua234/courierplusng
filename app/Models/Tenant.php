<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\DatabaseConfig;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
    */
    protected $fillable = ['id', 'data'];

    protected $casts = [
        'data' => 'array', // Ensure 'data' is cast properly
    ];

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

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }
}
