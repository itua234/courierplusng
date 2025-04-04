<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = ['tenant_id', 'domain'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
