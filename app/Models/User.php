<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

#[Fillable(['name', 'email', 'phone_number', 'password', 'signature_path', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    public function getFirstNameAttribute(): string
    {
        return Str::before($this->name, ' ');
    }

    public function getNameInitials(): string
    {
        return Str::substr($this->name, 0, 1) . Str::substr(Str::after($this->name, ' '), 0, 1);
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }

    public function receipts(): HasMany
    {
        return $this->hasMany(Receipt::class);
    }
    
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
}
