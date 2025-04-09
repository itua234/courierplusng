<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
//use App\Notifications\ResetPasswordNotification;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable implements CanResetPassword
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'email_verified_at',
        'photo',
        'googleId',
        'status',
        'tenant_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'tenant_id'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Send a password reset notification to the user.
     * @param string $token
    */
    public function sendPasswordResetNotification($token): void
    {
        $url = env("APP_URL")."/reset-password/".$this->email."/".$token;

        //$this->notify(new ResetPasswordNotification($url));
    }

    protected function firstname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => ucwords(strtolower($value))
        );
    }

    protected function lastname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => ucwords(strtolower($value))
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => strtolower($value),
        );
    }

    /**
     * Get the tenant associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

}
