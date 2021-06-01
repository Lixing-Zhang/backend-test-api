<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    const STATUS_AVAILABLE = 'available';
    const STATUS_CHECKED_OUT = 'checked out';

    protected $guarded = [];

    public function checkouts(): HasMany
    {
        return $this->hasMany(Checkout::class);
    }

    public function getCheckoutAttribute(): ?Model
    {
        if ($this->status == static::STATUS_AVAILABLE) {
            return null;
        }

        return $this->checkouts()->whereDoesntHave('checkin')->sole();
    }
}
