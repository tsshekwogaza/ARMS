<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = ['user_id', 'title', 'address', 'city', 'type', 'rent_rate', 'image_url', 'unit'];

    public function landlord(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }
}